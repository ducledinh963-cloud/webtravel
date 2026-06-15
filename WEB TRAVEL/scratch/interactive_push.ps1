$cmd = @"
cd 'c:\xampp\htdocs'
git config --global --add safe.directory C:/xampp/htdocs
git init
git remote remove origin
git remote add origin https://github.com/ducledinh963-cloud/webtravel.git
git branch -M main
git config user.email "ducledinh963@gmail.com"
git config user.name "ducledinh963-cloud"
git add "WEB TRAVEL"
git commit -m "Add WEB TRAVEL folder and project files"
Write-Host "==========================================================" -ForegroundColor Yellow
Write-Host "Chuan bi day code len GitHub..." -ForegroundColor Yellow
Write-Host "Cua so dang nhap (popup) se hien len." -ForegroundColor Yellow
Write-Host "Vui long dang nhap tai khoan: ducledinh963-cloud" -ForegroundColor Yellow
Write-Host "==========================================================" -ForegroundColor Yellow
git push -f origin main
Write-Host "Da day code xong! Nhan phim bat ky de dong." -ForegroundColor Green
Read-Host
"@

Start-Process powershell.exe -ArgumentList "-NoExit", "-Command", $cmd
