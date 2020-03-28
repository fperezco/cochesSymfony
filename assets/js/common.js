function deleteConfirmation(name, urlSubmit) {
    swal({
        title: "Borrar Elemento?",
        text: "Borrar " + name + "?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = urlSubmit;
            } else {
                //swal("Your imaginary file is safe!");
            }
        });
}

window.deleteConfirmation = deleteConfirmation;
