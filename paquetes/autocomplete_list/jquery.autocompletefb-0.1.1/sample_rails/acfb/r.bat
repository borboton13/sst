ruby vendor\rails\railties\bin\rails ..\%1 -dsqlite3
xcopy /s /e /y /I vendor ..\%1\vendor
copy *.bat ..\%1
copy *.rb  ..\%1
CD ..\%1
rem ruby sc.rb
rem rake db:migrate
