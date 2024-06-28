
const fragment = new DocumentFragment();

const sweetAlert2 = (options)=>{
    let {title,text,icon} = options;
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'ok'
      })
}

const errorInfo = (errorsResponse,idContainer = 'error-container')=>{
    let errors = Object.entries(errorsResponse.errors);
    let errorsValues = Object.values(errors);
    let $errorContainer = document.getElementById(idContainer);
    errors.forEach(([field,messages])=>{
        messages.forEach(message => {
            console.log(message);
            let $span = document.createElement('span');
            $span.classList.add('text-danger');
            $span.classList.add('d-block');
            $span.textContent = message;
    
            fragment.appendChild($span);

        })
    })
    $errorContainer.appendChild(fragment);
    setTimeout(()=>{
        $errorContainer.innerHTML = '';
    },5000);

}

export{
    sweetAlert2,
    errorInfo
}