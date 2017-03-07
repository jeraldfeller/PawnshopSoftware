/* INSERT PAWN ITEM */

	//Program a custom submit function for the form
	$("form#data").submit(function(event){

	  //disable the default form submission
	  event.preventDefault();
        event.stopPropagation();

        //grab all form data
	  var formData = new FormData($(this)[0]);

	  $.ajax({
		url: 'add-pawn-items-function.php',
		type: 'POST',
		data: formData,
		async: false,
		cache: false,
		contentType: false,
		processData: false
	  });

	  return false;

    });


	$("form#dataOutright").submit(function(event){



        //disable the default form submission
        event.preventDefault();

        //grab all form data
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: 'add-outright-items-function.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });



    $("form#dataRepair").submit(function(event){



        //disable the default form submission
        event.preventDefault();

        //grab all form data
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: 'add-new-parts-function.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });

    $("form#petty-cash-form").submit(function(event){



        //disable the default form submission
        event.preventDefault();

        //grab all form data
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: 'add-petty-cash-function.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false
        });

        return true;
    });

    $("form#dataScrap").submit(function(event){



        //disable the default form submission
        event.preventDefault();

        //grab all form data
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: 'add-scrap-item-function.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });





