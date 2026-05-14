import json

log_path = "/Users/hesharasandeepa/.gemini/antigravity/brain/64422591-5e3e-4431-b4fd-a3780ac61285/.system_generated/logs/overview.txt"
workspace = "/Users/hesharasandeepa/Desktop/Libry_Management_System/"

files = ["auth/login.php", "index.php", "features/user_management.php", "features/category_Reg.php", "features/assign_fine.php"]

# Clear reverse_apply.py
with open('reverse_apply.py', 'w', encoding='utf-8') as out:
    pass

with open(log_path, 'r', encoding='utf-8') as f:
    for line in f:
        if line.startswith('{'):
            try:
                data = json.loads(line)
                if 'tool_calls' in data:
                    for tc in data['tool_calls']:
                        if tc['name'] == 'replace_file_content' or tc['name'] == 'multi_replace_file_content':
                            args = tc['args']
                            filepath = args.get('TargetFile', '')
                            for rel_path in files:
                                if rel_path in filepath:
                                    with open('reverse_apply.py', 'a', encoding='utf-8') as out:
                                        out.write(f"# Reverting {rel_path}\n")
                                        out.write("import sys\n")
                                        if tc['name'] == 'replace_file_content':
                                            out.write(f"with open('{workspace}{rel_path}', 'r', encoding='utf-8') as f: content = f.read()\n")
                                            out.write(f"target = {repr(args['ReplacementContent'])}\n")
                                            out.write(f"replacement = {repr(args['TargetContent'])}\n")
                                            out.write(f"content = content.replace(target, replacement)\n")
                                            out.write(f"with open('{workspace}{rel_path}', 'w', encoding='utf-8') as f: f.write(content)\n")
                                        else:
                                            out.write(f"with open('{workspace}{rel_path}', 'r', encoding='utf-8') as f: content = f.read()\n")
                                            chunks = args['ReplacementChunks']
                                            if isinstance(chunks, str):
                                                chunks = json.loads(chunks)
                                            for chunk in chunks:
                                                out.write(f"target = {repr(chunk['ReplacementContent'])}\n")
                                                out.write(f"replacement = {repr(chunk['TargetContent'])}\n")
                                                out.write(f"content = content.replace(target, replacement)\n")
                                            out.write(f"with open('{workspace}{rel_path}', 'w', encoding='utf-8') as f: f.write(content)\n")
            except Exception as e:
                pass
