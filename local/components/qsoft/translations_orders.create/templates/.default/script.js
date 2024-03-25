function addFields() {
    event.preventDefault()
    const form = BX('form')
    const data = new FormData(form)

    BX.ajax.runComponentAction('qsoft:translations_orders.create', 'submitForm', {
        mode: 'class',
        data: data
    }).then(function (response) {
        console.log(response)
    }, function (response) {
    })
}
