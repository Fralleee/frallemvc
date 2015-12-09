# Frallemvc
MVC & CMS project coded in PHP

## TODO
- If logged in and visit login page should redirect to Home
- Autologin after registration (TEMP FIX)
- Output handler, check if $data[xxx] exists and output (static class)
- Better model handling, shouldn't be necessary to convert to array
- Cleanup on isle 5: Rewrite code to be consistent
- Rewrite picture class to be static helper
- Write user class to function with login and register etc.
- Add more config paths (create config.php in core, add root_path, etc.)
- Look for better ways to handle POST and GET in controllers
- Add cropping to images when uploaded to match specific image dimensions (ex. product image = 420 x 200)
- Remove shop-specific code and branch it into its own repository
- Alter resize-funtion to be smaller

## Patch notes
###2015-12-09
- Added Picture-class
- Updated readme with Todo