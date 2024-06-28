import { createDataTable,reloadTable } from "../helpers/dataTable.js";
import {
    fillFildOfEditForm,
    sendForm,
    addInput,
    hideModal
} from "../helpers/form.js";
import { request } from "../helpers/fetch.js";
import {sweetAlert2,errorInfo} from "../helpers/alerts.js";
import { PATHS } from "../helpers/config.js";

const idFormModal = 'modal';

const fragment = new DocumentFragment();

const BASEPATH = PATHS.lend;

let dataTables = {
    'lend-table': ''
};


let fetchOptions = {
    method: "POST",
    body: [],
    headers:{
        'Accept': 'application/json'
    }
    
};

const loadSelectOptions = async (options) => {
    let { url, idSelect } = options;
    let data = await request(url);
    
    if(data.lenght == 0) return;

    let select = document.getElementById(idSelect);
    data.forEach((value) => {
        let option = document.createElement("option");
        option.value = value["id"];
        option.textContent = value['name'];
        fragment.appendChild(option);
    });
    select.appendChild(fragment);
};



document.addEventListener("DOMContentLoaded", () => {
    dataTables["lend-table"] = createDataTable({
        idTable: "home-table",
        ajax: BASEPATH,
        columns: [
            { data: "id" },
            { data: "quantity" },
            { data: "start_date" },
            { data: "end_date" },
            { data: "user.name" },
            { data: "book.name" },
            { data: "actions" },
        ],
    });

    loadSelectOptions({
        url: PATHS.user,
        idSelect: "user-select",
    });
    loadSelectOptions({
        url: PATHS.book,
        idSelect: "book-select",
    });
});

document.addEventListener("click", async (e) => {
    let $button = e.target;
    let route;
    switch ($button.id) {
        case "edit-btn":
            route = BASEPATH + `/${$button.getAttribute("data-id")}`;
            await fillFildOfEditForm(route, "book-form");
            addInput({
                idForm: "book-form",
                inputName: "_method",
                type: "hidden",
                value: "PUT",
            });

            addInput({
                idForm: "book-form",
                type: "hidden",
                inputName: "_action",
                value: route,
            });
            break;

        case "create-lend":
            route = BASEPATH;
            addInput({
                idForm: "book-form",
                type: "hidden",
                inputName: "_method",
                value: "POST",
            });

            addInput({
                idForm: "book-form",
                type: "hidden",
                inputName: "_action",
                value: route,
            });
            break;

        case "btn-delete":
            route = `${BASEPATH}/returned/${$button.getAttribute('data-id')}`;
            let response = await request(route,fetchOptions);
            sweetAlert2({title:'Successfull',text:response.message,icon:'success'})
            reloadTable(dataTables["lend-table"]);

        break;
    }
});

document.addEventListener("submit", async (e) => {
    e.preventDefault();
    let $form = e.target;
    let route;

    switch ($form.id) {
        default:
            route = $form._action.value;
            fetchOptions.body = new FormData($form);

            sendForm(
                route,
                fetchOptions,
                (response) => {
                    console.log(response);
                    sweetAlert2({title:'Successfull',text:response.message,icon:'success'})
                    $form.reset();
                    hideModal(idFormModal);
                    reloadTable(dataTables["lend-table"]);
                },
                (errorResponse) => {
                    let errorCode = errorResponse.response.status;
                    if(errorCode !== 402){
                        sweetAlert2({title:'Error',text:errorResponse.message,icon:'error'})
                        return;
                    }
                    
                    errorInfo(errorResponse);
                }
            );

            break;
    }
});
