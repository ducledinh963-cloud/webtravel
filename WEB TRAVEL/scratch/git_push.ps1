# Powershell script to push project to GitHub
$repoUrl = "https://github.com/ducledinh963-cloud/webtravel.git"
$email = "ducledinh963@gmail.com"
$username = "ducledinh963-cloud"
$tempDir = "git_temp"

Write-Host "Creating temp directory..."
if (Test-Path $tempDir) {
    Get-ChildItem -Path $tempDir -Recurse -Force | ForEach-Object { $_.Attributes = 'Normal' }
    Remove-Item -Path $tempDir -Recurse -Force
}
New-Item -ItemType Directory -Path $tempDir -Force

Write-Host "Cloning repository..."
git clone $repoUrl $tempDir

if (Test-Path "$tempDir/.git") {
    Write-Host "Configuring git..."
    Push-Location $tempDir
    git config user.email $email
    git config user.name $username
    Pop-Location

    Write-Host "Creating WEB TRAVEL folder in repository structure..."
    $destFolder = "$tempDir/WEB TRAVEL"
    New-Item -ItemType Directory -Path $destFolder -Force

    Write-Host "Copying project files..."
    Get-ChildItem -Path . -Exclude $tempDir, "scratch", ".git" | Copy-Item -Destination $destFolder -Recurse -Force

    Write-Host "Staging and committing files..."
    Push-Location $tempDir
    git add .
    git commit -m "Add WEB TRAVEL folder and files"
    
    Write-Host "Pushing to GitHub..."
    git push origin main
    Pop-Location

    Write-Host "Cleaning up temp files..."
    Get-ChildItem -Path $tempDir -Recurse -Force | ForEach-Object { $_.Attributes = 'Normal' }
    Remove-Item -Path $tempDir -Recurse -Force
    Write-Host "Done!"
} else {
    Write-Error "Failed to clone repository. Make sure the repository URL is correct and you have permission."
}
