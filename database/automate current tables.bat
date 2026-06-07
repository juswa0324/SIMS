@echo off
set DB_USER=sims
set DB_PASS=sims@2026
set DB_NAME=sims

echo Running current tables...
for %%f in ("current tables\*.sql") do (
    echo Applying %%f...
    mysql -u %DB_USER% -p%DB_PASS% %DB_NAME% < %%f
)


echo All scripts executed.
pause
