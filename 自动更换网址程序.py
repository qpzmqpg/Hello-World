import os
import re

def replace_in_file(file_path, old_string, new_string):
    try:
        with open(file_path, 'r', encoding='utf-8') as file:
            file_content = file.read()
        
        if old_string in file_content:
            print(f'Found "{old_string}" in {file_path}. Replacing with "{new_string}".')
        else:
            print(f'"{old_string}" not found in {file_path}.')
        
        new_content = re.sub(old_string, new_string, file_content)
        
        with open(file_path, 'w', encoding='utf-8') as file:
            file.write(new_content)
        
        print(f'Successfully replaced in: {file_path}')
    except UnicodeDecodeError:
        print(f'Error reading file: {file_path}. File may not be in UTF-8 encoding.')

def batch_replace(directory, old_string, new_string, file_extension=None):
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file_extension is None or file.endswith(file_extension):
                file_path = os.path.join(root, file)
                replace_in_file(file_path, old_string, new_string)

# 使用示例
directory = 'C:\\Users\\Administrator\\Desktop\\网站'  # 替换为你的目录路径
old_string = r'qpzmqpg\.wuaze\.com'  # 使用转义字符以匹配正则表达式
new_string = 'qpzmqpg.yuun.ink'
file_extension = None  # 可以指定文件扩展名，如果要处理所有文件，设置为 None

batch_replace(directory, old_string, new_string, file_extension)
