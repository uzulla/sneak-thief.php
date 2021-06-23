# Some tweak for un-touchable PHP code

- `sneak_theaf.php` sample of full set.
- `steal-cookie.php` sample for cookie.
- `steal-session.php` sample for session.
- `old_skool.php` just a sample target app.

## How to use.

set `auto_prepend_file` directive to php.ini.

ex:

```
$ php -d auto_prepend_file=sneak_thief.php -S 127.0.0.1:3000
```

or, write `auto_prepend_file=sneak_thief.php` to `php.ini`/`.htaccess` or somewhere.

> `auto_prepend_file` directive is `PHP_INI_PERDIR`.

## what is "untouchable"?

#### Situation A

- Boss: "Please check this. some cookie will be corrupt."
- Me: "Ok, I'll be checking."
- Boss: "You do not have permission to edit the code, Because this is online."
- Me: "... ok."
- Boss: "The problem only in production server. You can not use debugger too."
- Me: "Uh."

#### Situation B,C,D ....

{If You need this section, Please sign an NDA with me.}

## LICENSE

MIT