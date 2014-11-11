@ECHO OFF
PUSHD .
FOR /R %%d IN (.) DO (
    cd "%%d"
    IF EXIST css (
       rd /s /q css
    )
	IF EXIST images (
       rd /s /q images
    )
)
POPD