# Fibonacci shortcode plugin coding exercise

Objective was to create a Wordpress plugin that adds two new shortcodes to wordpress:
[fibonacci length=1] Prints fibonacci sequence at given length.
[fibonacci-reverse length=1] Prints reversed fibonacci sequence at given length.
Clicking the sequence in UI initiates an ajax-request that saves the given value as post meta data called "fibonacci_sequence" or "fibonacci_reversed" depending on shortcode.
Use of also lambda function(s) and a trait(s) in a meaningful way was also requested.
Plugin is compatible with WP 5.4 ->

### Notes
- Plugin is wrapped in a class and check is made that there are no other classes with same name in global namespace
- All other PHP files are included only as traits
- JS and CSS are registered, but only loaded if the shortcode is used and are loaded only once
- In case of missing or invalid length parameter (less than 1 or not a number) a warning div is shown
- Both shortcodes are created with the same function and tag parameter is used to determine which one was is used
- If updating metadata fails, error message is alerted, in case of success metadata is added to post
- If post metadata is already same as the one used for update, nothing is done but code returns success
- Success response type also returns values, but only to show meaningful way to return something that could also be utilized
