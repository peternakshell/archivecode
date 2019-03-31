:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:: Tiny Dictionary Generator by me :D
:: ./MyHeartIsyr a.k.a Shikata_Ga_Nai
:: Only works in Windows
:: This tool is Free and Open Source, so you can fix or modify it
:: If possible, i want to remake this 
:: tool in another scripting / programming language
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
@echo off
cls
color 0c
title ::..::Dictionary Generator::..::
echo        _____________
echo       //Dictionary//\
echo      //Generator // /
echo     //__________// /
echo    /            / /
echo   /            / /
echo  /            / /
echo /____________/ /
echo \_____________/
echo.
echo By ./MyHeartIsyr
echo.
echo Silakan isi beberapa informasi berikut.
echo.
set /p depan="Nama Depan:"
set /p belakang="Nama Belakang:"
set /p nick="Panggilan:"
set /p birth="Tanggal Lahir:"
echo.
set /p suka="Nama pacar atau mantan:"
set /p suka2="Nama belakang:"
set /p nack="Panggilan:"
set /p date="Tanggal Lahir:"
echo.
set /p anak="Nama depan anak:"
set /p anak2="Nama belakang:"
set /p neck="Panggilan:"
set /p dateku="Tanggal Lahir:"
echo.
set /p pet="Nama hewan peliharaan:"
set /p company="Nama perusahaan:"
set /p key="Pakai informasi tambahan? [y/n]:"
if %key%==y goto isi
if %key%==n goto tanya1
:isi
set /p key1="Nama Ayah:"
set /p key2="Nama Ibu:"
set /p key3="Nama tim sepakbola favorit:"
set /p key4="Alamat rumah:"
set /p key5="Nama pengarang favorit:"
set /p key6="Nama kota kelahiran:"
set /p key7="Nama aktor/aktris favorit:"
set /p key8="Judul film favorit:"
set /p key9="Tanggal jadian/pernikahan:"
set /p key10="Pekerjaan impian:"
set /p key11="Hari favorit:"
set /p key12="Nama sahabat:"
set /p key13="Nama guru cs-an:"
set /p key14="Cita-cita:"
set /p key15="Nama tim basket favorit:"
set /p key16="Nama tim olahraga lain yang favorit:"
goto tanya2
:tanya1
set /p lanjut="Langsung bikin? [y/n]:"
if %lanjut%==y goto bikin1
if %lanjut%==n goto keluar
:tanya2
set /p lanjut="Langsung bikin? [y/n]:"
if %lanjut%==y goto bikin2
if %lanjut%==n goto keluar
:bikin1
echo %depan%> %depan%.txt
echo %belakang%>> %depan%.txt
echo %nick%>> %depan%.txt
echo %birth%>> %depan%.txt
echo %suka%>> %depan%.txt
echo %suka2%>> %depan%.txt
echo %nack%>> %depan%.txt
echo %date%>> %depan%.txt
echo %anak%>> %depan%.txt
echo %anak2%>> %depan%.txt
echo %neck%>> %depan%.txt
echo %dateku%>> %depan%.txt
echo %pet%>> %depan%.txt
echo %company%>> %depan%.txt
echo Kamus password berhasil dibuat dengan nama %depan%.txt
echo Jika dirasa kurang lengkap bisa diedit lagi file kamusnya
echo Strike any key when ready...
pause>nul
goto keluar
:bikin2
echo %depan%> %depan%.txt
echo %belakang%>> %depan%.txt
echo %nick%>> %depan%.txt
echo %birth%>> %depan%.txt
echo %suka%>> %depan%.txt
echo %suka2%>> %depan%.txt
echo %nack%>> %depan%.txt
echo %date%>> %depan%.txt
echo %anak%>> %depan%.txt
echo %anak2%>> %depan%.txt
echo %neck%>> %depan%.txt
echo %dateku%>> %depan%.txt
echo %pet%>> %depan%.txt
echo %company%>> %depan%.txt
echo %key1%>> %depan%.txt
echo %key2%>> %depan%.txt
echo %key3%>> %depan%.txt
echo %key4%>> %depan%.txt
echo %key5%>> %depan%.txt
echo %key6%>> %depan%.txt
echo %key7%>> %depan%.txt
echo %key8%>> %depan%.txt
echo %key9%>> %depan%.txt
echo %key10%>> %depan%.txt
echo %key11%>> %depan%.txt
echo %key12%>> %depan%.txt
echo %key13%>> %depan%.txt
echo %key14%>> %depan%.txt
echo %key15%>> %depan%.txt
echo %key16%>> %depan%.txt
echo Kamus password berhasil dibuat dengan nama %depan%.txt
echo Jika dirasa kurang lengkap bisa diedit lagi file kamusnya
echo Strike any key when ready...
pause>nul
goto keluar
:keluar
echo (C)opyleft ./MyHeartIsyr