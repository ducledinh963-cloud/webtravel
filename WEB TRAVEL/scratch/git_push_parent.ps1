# Powershell script to push project from parent directory to GitHub
$repoUrl = "https://github.com/ducledinh963-cloud/webtravel.git"
$email = "ducledinh963@gmail.com"
$username = "ducledinh963-cloud"

Write-Host "Initializing git in parent directory..."
git -C .. init

Write-Host "Configuring remote, branch and user..."
git -C .. remote remove origin 2>$null
git -C .. remote add origin $repoUrl
git -C .. branch -M main
git -C .. config user.email $email
git -C .. config user.name $username

Write-Host "Staging WEB TRAVEL directory..."
git -C .. add "WEB TRAVEL"

Write-Host "Committing files..."
git -C .. commit -m "Add WEB TRAVEL folder and project files"

Write-Host "Pushing to GitHub..."
git -C .. push -f origin main

Write-Host "Cleaning up parent git repository..."
if (Test-Path "../.git") {
    Get-ChildItem -Path "../.git" -Recurse -Force | ForEach-Object { $_.Attributes = 'Normal' }
    Remove-Item -Path "../.git" -Recurse -Force
}
Write-Host "Done!"
