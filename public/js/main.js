window.eraseContact = (id) => {
    fetch(`/contacts/${id}`, {
        method: 'DELETE'
    }).then(async (response) => {
        
        const data = await response.json();
        
        $('#api-message-toast').toast('show');
        
        $('.toast-body').text(data.message)
        
        window.location.reload();
        
    }).catch(error => {
        console.error('Error:', error);
    });
}

window.editContact = (id) => {
    fetch(`/contacts/${id}`, {
        method: 'GET'
    }).then(async (response) => {
        
        const data = await response.json();
        console.log(data);
        $('#form-contacts-modal').modal('show');
        
        $('#form-contacts input[name="id"]').val(data.id);
        $('#form-contacts input[name="name"]').val(data.name);
        $('#form-contacts input[name="email"]').val(data.email);
        $('#form-contacts input[name="document"]').val(data.document);
        $('#form-contacts input[name="phone"]').val(data.phone);
        $('#form-contacts input[name="alias"]').val(data.alias);
        
    }).catch(error => {
        console.error('Error:', error);
    });
    
}

window.dataIsValid = (data) => {
    let status = true
    let fields = []

    if(data.name.length < 3 || data.name.length > 255) {
        status = false;
        fields.push('name');
    }
    
    if(data.email.length < 3 || data.email.length > 255) {
        status = false;
        fields.push('email');
    }

    if(data.document.length !== 11) {
        status = false;
        fields.push('document');
    }
    
    if(data.phone.length !== 11) {
        status = false;
        fields.push('phone');
    }
    
    if(data.alias.length < 3 || data.alias.length > 55) {
        status = false;
        fields.push('alias');
    }

    return { status, fields }
}


$('#form-contacts').on('submit', function (e) {
    e.preventDefault();
    
    const formData = $(this).serializeJSON();
    
    const isValid = dataIsValid(formData);
    
    if(!isValid.status) {
        isValid.fields.forEach(field => {
            $(`#form-contacts input[name="${field}"]`).addClass('is-invalid');
            $(`#form-contacts input[name="${field}"] + .error-message`).toggleClass('d-none');
        });
        return;
    }
    
    const endpoint = formData.id ? `/contacts/${formData.id}` : '/contacts/';
    const method = formData.id ? 'PUT' : 'POST';
    
    fetch(endpoint, {
        method,
        body: JSON.stringify(formData)
    }).then(async (response) => {

        const data = await response.json();
        
        $('#api-message-toast').toast('show');
        
        $('.toast-body').text(data.message)
        
        window.location.reload();
        
    }).catch(error => {
        console.error('Error:', error);
        $('.toast-body').text(error.message)
        $('#api-message-toast').toast('show');
    });
})

$('[data-mdb-tab-init]').each(function (index, element) {
    $(element).on('click', function (e) {
        e.preventDefault();

        $(element).parent().addClass('active');
        $($(element).attr('href')).addClass('show active');

        $(element).parent().
        siblings().removeClass('active');
        $($(element).attr('href')).siblings().removeClass('show active');

    });
});

$('#contact-modal-btn').on('click', function () {
    $('#form-contacts-modal').modal('show');
});

$('#close-contact-modal-btn').on('click', function () {
    $('#form-contacts-modal').modal('hide');
});

$('#api-message-toast').on('hidden.bs.toast', function () {
    window.location.reload();
})

$('#search-input').on('keyup', function(e) {

    if(e.target.value === '') {
        $('#contacts-table tbody tr').removeClass('d-none');
        return;
    }

    $('#contacts-table tbody tr').each(function(index, element) {
        const search = $(element).text().toLowerCase();
        const value = e.target.value.toLowerCase();
        if(search.indexOf(value) === -1) {
            $(element).addClass('d-none');
        } else {
            $(element).removeClass('d-none');
        }
    });
});

$('a.a-filter').each(function(index, element) {
    $(element).on('click', function(e) {
        e.preventDefault();
        const filter = $(element).attr('data-filter');
        const order = window.location.search.split('order=')[1] === 'asc' ? 'desc' : 'asc';
       window.location = `/contacts/?date=${filter}&order=${order}`;
    })
})

$().ready(function() {
    const url = new URL(window.location.href);
    const date = url.searchParams.get('date');
    const order = url.searchParams.get('order');

    if(!date) return;

    $(`a.a-filter[data-filter="${date}"]`).siblings().toggleClass('d-none');
    $(`a.a-filter[data-filter="${date}"]`).siblings().toggleClass(order === 'desc' ? 'fa-caret-up' : 'fa-caret-down');
})
