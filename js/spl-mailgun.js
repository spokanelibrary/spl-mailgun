// mailgun.js

var org = {

	// added on script load
	config: {
						endpoint: { hzws: 'http://api.spokanelibrary.org/v2/hzws/' }
					 }

	// added on authentication
	,user: {}

	// called on script load
	,init: function() {
		_self = this;

		// init ui
		this.initMailgun();

	} // init()

, initMailgun: function() {
		$form = $('form.spl-mailgun');
		$form.validate();		
		console.log($form);
		//$form.validate();
		//console.log('validate');
  } // initValues()

};

org.init();