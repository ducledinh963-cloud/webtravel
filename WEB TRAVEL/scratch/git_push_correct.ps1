# Clean up any git inside WEB TRAVEL first
if (Test-Path "C:\xampp\htdocs\WEB TRAVEL\.git") {
    Get-ChildItem -Path "C:\xampp\htdocs\WEB TRAVEL\.git" -Recurse -Force -ErrorAction SilentlyContinue | ForEach-Object { $_.Attributes = 'Normal' }
    Remove-Item -Path "C:\xampp\htdocs\WEB TRAVEL\.git" -Recurse -Force -ErrorAction SilentlyContinue
}

# Go to parent folder and push
cd 'C:\xampp\htdocs'
git config --global --add safe.directory C:/xampp/htdocs
git init
git remote remove origin 2>$null
git remote add origin https://github.com/ducledinh963-cloud/webtravel.git
git branch -M main
git config user.email "ducledinh963@gmail.com"
git config user.name "ducledinh963-cloud"
git add "WEB TRAVEL"
git commit -m "Add WEB TRAVEL folder and project files"

Write-Host "==========================================================" -ForegroundColor Yellow
Write-Host "Chuan bi day code len GitHub..." -ForegroundColor Yellow
Write-Host "Cua so dang nhap (popup) se hien len." -ForegroundColor Yellow
Write-Host "Vui long dang nhap bang tai khoan ducledinh963-cloud cua ban." -ForegroundColor Yellow
Write-Host "==========================================================" -ForegroundColor Yellow

git push -f origin main

# Clean up parent git folder
Get-ChildItem -Path ".git" -Recurse -Force | ForEach-Object { $_.Attributes = 'Normal' }
Remove-Item -Path ".git" -Recurse -Force

Write-Host "Da day code xong! Nhan phim bat ky de dong." -ForegroundColor Green
Read-Host
