import os
import glob

# Rename all .html files to .php
html_files = glob.glob('*.html')
for file in html_files:
    new_name = file[:-5] + '.php'
    os.rename(file, new_name)
    print(f'Renamed {file} to {new_name}')

# Update content in all .php files to replace .html with .php
php_files = glob.glob('*.php')
for file in php_files:
    with open(file, 'r', encoding='utf-8') as f:
        content = f.read()
    updated_content = content.replace('.html', '.php')
    with open(file, 'w', encoding='utf-8') as f:
        f.write(updated_content)
    print(f'Updated links in {file}')
