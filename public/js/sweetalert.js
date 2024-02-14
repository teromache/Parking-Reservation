function confirmReservation() {
    event.preventDefault();
    
    const form = document.getElementById('reserveForm');

    if (form.checkValidity()) {
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'Do you want to contine?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
}
