(function ($) {

    //$('input[name=name], input[name=phone]').addClass('nowarnings'); добавить класс warnings в css

    $('input[name=name], input[name=phone]').on('keyup blur', function (e) {

        var target = $(e.target),
            reName = /^[a-zA-Zа-яА-Я_\- ]+$/,
            rePhone = /^[\d\- +\(\)]{4,20}$/,
            valid = false;

        if (!target.val()) {
            target.addClass('warnings');
            return false;
        }

        if (target.attr('name') === 'name') {
            valid = reName.test(target.val());
        } else if (target.attr('name') === 'phone') {
            valid = rePhone.test(target.val());
        }

        if (valid) {
            target.removeClass('warnings');
        } else {
            target.addClass('warnings');
        }
    });

    $('form').on('click', '[type=submit]',function (e) {

        e.preventDefault();

        var form = $(e.target).parents('form'),
            phone = form.find('input[name=phone]'),
            name = form.find('input[name=name]'),
            results;

        results = validate(form.get(0));

        if (results.error === true) {
            $.each(results.errors, function () {
                if (this.name === 'phone') {
                    phone.addClass('warnings');
                }

                if (this.name === 'name') {
                    name.addClass('warnings');
                }
            });
        } else
            form.submit();
    });

    function validate(form) {

        var rePhone, reName, phoneValue, nameValue, results = {error: false, errors: []},
            nameTag, phoneTag, inputs, validName = validPhone = false;

        inputs = form.getElementsByTagName('input');
        for(var i = 0; i < inputs.length; i++) {
            if (inputs[i].getAttribute('name') === 'name')
                nameTag = inputs[i];
            else if (inputs[i].getAttribute('name') === 'phone')
                phoneTag = inputs[i];
        }

        rePhone = /^[\d\- +\(\)]{4,20}$/;
        reName  = /^[a-zA-Zа-яА-Я_\- ]+$/;

        phoneValue = phoneTag.value;
        nameValue  = nameTag.value;

        var errorName = {};
        var errorPhone = {};

        if (!nameValue) {
            errorName.message = 'Необходимо заполнить поле \"Имя\".';
        } else {
            validName  = reName.test(nameValue);
            if (!validName) {
                errorName.message = "Имя указано не верно";
            }
        }

        if (!phoneValue) {
            errorPhone.message = 'Необходимо заполнить поле \"Телефон\".';
        } else {
            validPhone = rePhone.test(phoneValue);
            if (!validPhone) {
                errorPhone.message = "Телефон указан не верно";
            }
        }

        if (!validPhone) {
            errorPhone.name = 'phone';
            results.error = true;
            results.errors.push(errorPhone);
        }

        if (!validName) {
            errorName.name = 'name';
            results.error = true;
            results.errors.push(errorName);
        }

        return results;
    }
})(jQuery);