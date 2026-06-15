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
Write-Host "He thong se yeu cau nhap Username va Password truc tiep tai day." -ForegroundColor Yellow
Write-Host "1. Username: Nhap ducledinh963-cloud roi an Enter." -ForegroundColor Green
Write-Host "2. Password: Dan (Paste) ma Token (ghp_...) cua ban roi an Enter." -ForegroundColor Green
Write-Host "(Luu y: Khi dan mat khau/token, man hinh se khong hien thi ky tu nao, ban cu dan va an Enter la duoc)." -ForegroundColor Red
Write-Host "==========================================================" -ForegroundColor Yellow
git -c credential.helper= push -f origin main
Write-Host "Da day code xong! Nhan phim bat ky de dong." -ForegroundColor Green
Read-Host
"@

Start-Process powershell.exe -ArgumentList "-NoExit", "-Command", $cmd
