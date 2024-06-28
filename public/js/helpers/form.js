import {request} from '../helpers/fetch.js';



const sendForm = async(route,fetchOptions,succesfull,error)=>{
    let action = route;
    
        let response = await request(action,fetchOptions);
        if(response.error){
            error(response);
        }else{
            succesfull(response);
        }
}

const updateInput = (input,options)=>{
    let {type,value} = options;
    input.type = type;
    input.value = value;
}


const hideModal = (idModal)=>{
    $(`#${idModal}`).modal("hide");
        $(".modal-backdrop").remove();
}


const addInput = (options)=>{
    let {idForm,type,inputName,value} = options;
    let $form = document.getElementById(idForm);
    let createdInput = $form.querySelector(`input[name="${inputName}"]`);

    if(createdInput) {
        updateInput(createdInput,options);
    }
    else{
        let $input = document.createElement('input');
        $input.type = type;
        $input.name = inputName;
        $input.value = value;
    
        $form.insertAdjacentElement('afterbegin',$input);
    }

}


const fillFildOfEditForm = async(route,idForm)=>{
    let $form = document.getElementById(idForm);
    let data = await request(route);
    let arrayData= Array(data);

    let inputs = $form.querySelectorAll("input");

    arrayData.forEach(value=>{
        console.log(value);
        for(let i = 0; i<inputs.length; i++){
            let input = inputs[i];
            if(value[input.name]) {
                input.value = value[input.name];
            }
        }
    })

}


// const changeFormAction = (route,idForm)=>{
//     let $form  = document.getElementById(idForm);
//     $form.action = route;
// }

export{
    sendForm,
    hideModal,
    // changeFormAction,
    fillFildOfEditForm,
    addInput
}