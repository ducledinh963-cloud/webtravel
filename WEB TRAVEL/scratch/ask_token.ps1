[System.Reflection.Assembly]::LoadWithPartialName('Microsoft.VisualBasic') | Out-Null
$token = [Microsoft.VisualBasic.Interaction]::InputBox("Nhập GitHub Personal Access Token (PAT) để đẩy code:", "GitHub Token Authentication")
Write-Output "Token length: $($token.Length)"
