<?php

/**
 * This is an example field type extension for Simple Fields 
 * Use this as base or inspiration for your own fields
 */

// Make sure simple fields have loaded before we try to do anything. Will get errors otherwise.
add_action("plugins_loaded", function() {
	
	// Setup an example field type
	class simple_fields_field_example extends simple_fields_field {
	
		public
			$key         = "fieldExample", // Unique key for this field type. just a-z please, no spaces or funky stuff. don't change this once set.
			$name        = "Example field", // The name that users will see.
			$description = "This is an example field. Check out it's source!" // A longer description. Not used right now...
			;
		
		/**
		 * Please run the parent constructor, so the class can do stuff there if it wants to
		 */
		function __construct() {
			parent::__construct();
		}
		
		/**
		 * Output options this field type
		 * Don't worry about saving the values or how they get back. Simple Fields takes care of that.
		 */
		function options_output($existing_vals) {
			
			$output = "";
			
			simple_fields::debug("existing option vals for this field type", $existing_vals);
			
			// Example how to add a text field to the options page for this field type
			$output .= sprintf('
				<p>
					<label for="%2$s">My text option</label>
					<input type="text" name="%1$s" id="%2$s" value="%3$s">
				</p>
				',
				$this->get_options_name("myTextOption"),
				$this->get_options_id("myTextOption"),
				isset($existing_vals["myTextOption"]) ? esc_attr($existing_vals["myTextOption"]) : "No value entered yet"
			);

			// Example how to add a text area to the options page for this field type
			$output .= sprintf('
				<p>
					<label for="%2$s">Textareas are fine too</label>
					<textarea name="%1$s" id="%2$s">%3$s</textarea>
				</p>
				',
				$this->get_options_name("mapsTextarea"),
				$this->get_options_id("mapsTextarea"),
				isset($existing_vals["mapsTextarea"]) ? esc_attr($existing_vals["mapsTextarea"]) : "Enter some cool text here please!"
			);

			// Example how to add a checkbox field to the options page for this field type
			$output .= sprintf('
				<p>
					<input type="checkbox" name="%1$s" id="%2$s" %3$s>
					Check it!
				</p>
				',
				$this->get_options_name("aCheckbox"),
				$this->get_options_id("aCheckbox"),
				isset($existing_vals["aCheckbox"]) && $existing_vals["aCheckbox"] ? "checked" : ""
			);

			// Example how to add a dropdown field to the options page for this field type
			$output .= sprintf('
				<p>
					<label for="%2$s">Please select something in my dropdown</label>
					<select name="%1$s" id="%2$s">
						<option value="">Choose ...</option>
						<option value="val1" %3$s>Value number one</option>
						<option value="val2" %4$s>Value number two</option>
						<option value="val3" %5$s>Value number three</option>
						<option value="val4" %6$s>Value number four</option>
					</select>
				</p>
				',
				$this->get_options_name("funkyDropdown"),
				$this->get_options_id("funkyDropdown"),
				isset($existing_vals["funkyDropdown"]) && ($existing_vals["funkyDropdown"] == "val1" ) ? "selected" : "",
				isset($existing_vals["funkyDropdown"]) && ($existing_vals["funkyDropdown"] == "val2" ) ? "selected" : "",
				isset($existing_vals["funkyDropdown"]) && ($existing_vals["funkyDropdown"] == "val3" ) ? "selected" : "",
				isset($existing_vals["funkyDropdown"]) && ($existing_vals["funkyDropdown"] == "val4" ) ? "selected" : ""
			);
			
			// When we have created all output for options page we return the output
			return $output;

		}
		
		/**
		 * Output fields and stuff on post edit page
		 * This is the output a regular user will see
		 */
		function edit_output($saved_values, $options) {

			// name tex. date: simple_fields_fieldgroups[3][1][new0]
			// name denna: simple_fields_fieldgroups[3][2][new0][option1]
			// alltså ett steg till = bra för vi kan lagra fler saker med mindre problem. hej hopp.
			$output = "";			
			$output .= sprintf(
				'
					<input type="text" name="%1$s" id="%2$s" value="%3$s"><br>
					<input type="text" name="%4$s" id="%5$s" value="%6$s">
				',
				$this->get_options_name("option1"),
				$this->get_options_id("option1"),
				esc_attr(@$saved_values["option1"]),
				$this->get_options_name("option2"),
				$this->get_options_id("option2"),
				esc_attr(@$saved_values["option2"])
			);

			return $output;
			
		}
	
	}

	simple_fields::register_field_type("simple_fields_field_example");	
});
