=== Plugin Name ===
Contributors: Alex Gonzales
Tags: peruvian dni, person
Requires at least: 3.0.1
Tested up to: 3.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is a validator of peruvian DNI, however, to correctly validate 9 digit is needed. NOTE: this one only validates the structure.

== Description ==

English
--------

In the form register, admin panel or user profile, you can add the field DNI and the plugin will validate the structure using the 9 digits

Spanish
--------
En el formulario de registro, en el panel administrativo o en el perfil de usuario, tu puedes agregar el campo DNI y el plugin validará la estructura usando los 9 dígitos.


== Installation ==

1. Upload `GoDNI.zip` to the `/wp-content/plugins/` directory
2. Unzip the plugin
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

English
--------

= How I can access the DNI of each user? =

Using the code <?php echo get_user_meta($user_id, 'dni', true); ?>

= Why do I have to put 9 digits, here everyone just remember the first 8 digits ? =

I'm sorry, but we need the 9th digit to validate the whole structure

= My 9th digit is a letter, there is problem in it? =

There isn't problem, the last digit can be number or letter

Spanish
--------

= ¿Cómo puedo acceder al DNI de cada usuario? =

Usando el código <?php echo get_user_meta($user_id, 'dni', true); ?>

= ¿Por qué tengo que poner 9 dígitos, aquí todo el mundo sólo recuerda los primeros 8 dígitos? =

Lo siento, pero necesito el noveno dígito para validar toda la estructura

= ¿Mi noveno dígito es una letra, no hay problema en ello? =

No hay problema, el último dígito puede ser número o letra

== Screenshots ==

1. Field DNI in the form register
2. Settings
3. Column DNI in the admin panel
4. Field DNI in the user profile

http://blog.gopymes.pe/plugin-wp-social-godownload-1-0/

== Changelog ==

= 1.0 =
* This plugin is new.

== Upgrade Notice ==

= 1.0 =
This plugin is new.
