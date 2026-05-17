@echo off
set DB_USER=gflmci
set DB_PASS=Airetow321
set DB_NAME=gflmci

echo Running current tables...
for %%f in ("current tables\*.sql") do (
    echo Applying %%f...
    mysql -u %DB_USER% -p%DB_PASS% %DB_NAME% < %%f
)


echo All scripts executed.
pause
