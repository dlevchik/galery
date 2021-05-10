let messages = document.getElementById("message-container");
let gallery = document.getElementById("gallery");
let modalPicture = document.getElementById("modalPicture");
let addPicture = document.getElementById("addPicture");
let registrationForm = document.getElementById("registrationForm");
let loginForm = document.getElementById("login");
let editUsernameButton = document.getElementById("editUsernameButton");
let newProfilePicForm = document.getElementById("newProfilePicForm");
let profileOptions = document.getElementById("profileOptions");
let openedPicture;
let timeout = 100;
let fullURL = window.location.href || document.URL;
window.URL = window.URL || window.webkitURL;












function openModal(modal){
    modal.hidden = false;
    document.body.classList.add("modalOpen");

    setTimeout(()=>{modal.style.opacity = 1;}, timeout);

    if(modal.querySelector(".modalContent").getBoundingClientRect().top < 15){
        modal.querySelector(".modalContent").style.top = "20px";
    }
}

function closeModal(modal){
    modal.style.opacity = 0;

    setTimeout(()=>{
        modal.hidden = true;
        document.body.classList.remove("modalOpen");
    }, timeout);

    modal.querySelector(".modalContent").style.top = "unset";
}





if(messages){
    let currentMessage = 0;
    let messagesArray = messages.querySelectorAll('li');

    if(localStorage.getItem('message')){
        let li = document.createElement('li');
        li.classList.add("success");
        li.innerHTML = `<span>${localStorage.getItem('message')}</span> <button class=\"close\">&#9746;</button>`;
        messages.append(li);
        li.style.transform = `translateX(-${li.offsetWidth}px)`;

        setTimeout(() => {
            li.style.transform = "translateX(0px)";
            li.style.opacity = "1";
        }, timeout);

        localStorage.removeItem('message');
    }

    messagesArray.forEach(item => {
        item.style.transform = `translateX(-${item.offsetWidth}px)`;
    });

    function animateMessage(){
        messagesArray[currentMessage].style.transform = "translateX(0px)";
        messagesArray[currentMessage].style.opacity = "1";
        
        currentMessage += 1;
        if(currentMessage != messagesArray.length){
            setTimeout(animateMessage, timeout);
        }
    }

    messages.addEventListener('click', (event)=>{
        let li = event.target.closest("li");
        if(li){
            li.remove();
        }
    });

    if(messagesArray.length > 0){
        setTimeout(animateMessage, timeout);
    }
}






if(loginForm){
    let loginButton = document.getElementById("signIn");
    let loginModal = document.querySelector(".loginModal");
    loginModal.hidden = true;

    loginButton.addEventListener("click", ()=>{
        openModal(loginModal);
    });

    if(document.getElementById("regLogin")){
        document.getElementById("regLogin").addEventListener("click", (event)=>{
            event.preventDefault();
            openModal(loginModal);
        });
    }

    loginModal.addEventListener("click", (event)=>{
        if(event.target == loginModal || event.target == loginModal.querySelector(".modalContent")){
            closeModal(loginModal);
        }
    });
}







if(modalPicture){
    modalPicture.hidden = true;

    modalPicture.addEventListener("click", (event)=>{
        if(event.target.className == "container" || event.target == modalPicture){
            closeModalPicture();
        }
    });
    
    modalPicture.querySelector(".arrow-left").addEventListener("click", ()=>{
        if(!openedPicture.previousElementSibling) return;
    
        modalPicture.querySelector("picture").style.transform = "translateX(20px)";
        modalPicture.querySelector("picture").style.opacity = "0";
        modalPicture.querySelector(".info").style.transform = "translateX(20px)";
        modalPicture.querySelector(".info").style.opacity = "0";
    
        setTimeout(() => {
            modalPicture.querySelector("picture").style.transform = "translateX(-20px)";
            modalPicture.querySelector(".info").style.transform = "translateX(-20px)";
            changeModalPicture(openedPicture.previousElementSibling);
            openedPicture = openedPicture.previousElementSibling;
        }, 300);
    });
    
    modalPicture.querySelector(".arrow-right").addEventListener("click", ()=>{
        if(!openedPicture.nextElementSibling) return;
    
        modalPicture.querySelector("picture").style.transform = "translateX(-20px)";
        modalPicture.querySelector("picture").style.opacity = "0";
        modalPicture.querySelector(".info").style.transform = "translateX(-20px)";
        modalPicture.querySelector(".info").style.opacity = "0";
    
        setTimeout(() => {
            modalPicture.querySelector("picture").style.transform = "translateX(20px)";
            modalPicture.querySelector(".info").style.transform = "translateX(20px)";
            changeModalPicture(openedPicture.nextElementSibling);
            openedPicture = openedPicture.nextElementSibling;
        }, 300);
    });
    
    function fillModalPicture(src, description, title){
        modalPicture.querySelector("img").setAttribute("src", src);
        modalPicture.querySelector("img").setAttribute("alt", title);
        modalPicture.querySelector(".description").textContent = description;
        modalPicture.querySelector(".title").textContent = title;
        modalPicture.querySelector(".download").setAttribute("href", src);
    }
    
    function displayModalPicture(){
        openModal(modalPicture);
    
        setTimeout(() => {
            modalPicture.querySelector("picture").style.transform = "translateY(0px)";
            modalPicture.querySelector("picture").style.opacity = "1";
            modalPicture.querySelector(".info").style.transform = "translateY(0px)";
            modalPicture.querySelector(".info").style.opacity = "1";
        }, 100);
    }
    
    function closeModalPicture(){
        modalPicture.style.opacity = "0";
        setTimeout(() => {
            closeModal(modalPicture);
    
            modalPicture.querySelector("picture").style.transform = "translateY(-20px)";
            modalPicture.querySelector("picture").style.opacity = "0";
            modalPicture.querySelector(".info").style.transform = "translateY(-20px)";
            modalPicture.querySelector(".info").style.opacity = "0";
        }, 350);
    }
    
    function changeModalPicture(image){
        let src = image.querySelector("img").getAttribute("src");
        let description = image.querySelector(".description").textContent;
        let title = image.querySelector(".title").textContent;
    
        setTimeout(() => {
            modalPicture.querySelector("picture").style.transform = "translateX(0px)";
            modalPicture.querySelector("picture").style.opacity = "1";
            modalPicture.querySelector(".info").style.transform = "translateX(0px)";
            modalPicture.querySelector(".info").style.opacity = "1";
        }, 300);
    
        fillModalPicture(src, description, title);
    }
}















if(gallery){
    let currentPicture = 0;
    let pictureArray = document.querySelectorAll(".GalleryItem");


    function animatePicture(){
        pictureArray[currentPicture].style.transform = "translateY(0px)";
        pictureArray[currentPicture].style.opacity = "1";
        
        currentPicture += 1;
        if(currentPicture != pictureArray.length){
            setTimeout(animatePicture, timeout);
        }
    }

    setTimeout(animatePicture, timeout);

    gallery.addEventListener("click", (event) => {
        let image = event.target.closest(".GalleryItem");
        if(!image && !gallery.contains(image)) return;
    
    
        let src = image.querySelector("img").getAttribute("src");
        let description = image.querySelector(".description").textContent;
        let title = image.querySelector(".title").textContent;
    
        openedPicture = image;
        fillModalPicture(src, description, title);
    
        displayModalPicture();
    });

    document.addEventListener('click', (event)=>{
        if(event.target.closest(".delete")) {
            let confirmation = confirm("Are you sure you want to delete that photo?");
            if(!confirmation){
                event.preventDefault();
            }
        };
    });
}









if(addPicture){
    let dropArea = document.getElementById("drop");
    let selectButton = document.getElementById("selectButton");
    let fileInput = document.getElementById("file");
    let addPhotoButton = document.getElementById("addPhotoButton");
    let pictureForm = document.getElementById("pictureForm");
    let Photofile;
    addPicture.hidden = true;

    addPhotoButton.addEventListener("click", () => {
        openModal(addPicture);
    });
    
    addPicture.addEventListener("click", (event) => {
        if(event.target == addPicture || event.target == addPicture.querySelector(".modalContent")){
            closeModal(addPicture);
        }
    });

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, (event)=>{
            dropArea.classList.add("highlight");
        }, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, (event)=>{
            dropArea.classList.remove("highlight");
        }, false);
    });
    
    dropArea.addEventListener("drop", (event) => {
        selectButton.addEventListener("click", disableSelectButton(event));
        setTimeout(() => {
            selectButton.removeEventListener("click", disableSelectButton);
        }, 200);
    
        if(Photofile || fileInput.files[0]) return;
        if(!event.dataTransfer.files[0].type.startsWith("image/")){
            alert("file must be an image!");
            return;
        }
        Photofile = event.dataTransfer.files[0];
    
        previewPhoto(Photofile);
    }, false);
    
    fileInput.addEventListener("change", () => {
        if(!fileInput.files[0].type.startsWith("image/")){
            fileInput.value = "";
            alert("file must be an image!");
            return;
        }
        if(Photofile) return;
    
        previewPhoto(fileInput.files[0]);
    });
    
    function disableSelectButton(event){
        event.preventDefault();
    }
    
    selectButton.addEventListener("click", (event) => {
        if(Photofile || fileInput.files[0]) event.preventDefault();
    });
    
    function previewPhoto(Photofile){
        let img = document.createElement("img");
        img.setAttribute("src", window.URL.createObjectURL(Photofile));
        img.onload = () => {
            window.URL.revokeObjectURL(this.src);
    
            if(addPicture.querySelector(".modalContent").getBoundingClientRect().top < 15){
                addPicture.querySelector(".modalContent").style.top = "20px";
            }
    
            selectButton.style.background = "rgb(104, 104, 104)";
            selectButton.style.cursor = "not-allowed";
        }
        
        document.getElementById("preview").append(img);
    }
    
    
    pictureForm.addEventListener("submit", (event) =>{
        event.preventDefault();
        
        let form = new FormData(pictureForm);
        if(form.get("image").size == 0){
            form.set("image", Photofile);
        }
    
        for (let elem of form.entries()) {
            console.log(elem);
        }
    
        if(!form.get("image").size){
            alert("no image selected!");
            return;
        }
    
        //fetch(fullURL + "api.php", {
        fetch("http://galery/api.php", {
            method: 'POST',
            body: form,
        }).then(response => {
            console.log(response);
            localStorage.setItem("message", "Photo successfully posted");

            window.location.replace(fullURL);
        });
    });
}









if(registrationForm){
    
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    registrationForm.addEventListener("submit", (event)=>{
        if( registrationForm.elements.password.value.length < 6 ) {
            event.preventDefault();
            alert("passwords must have at least 6 characters! try again");
            return;
        }

        if( registrationForm.elements.password.value.length >= 40 ) {
            event.preventDefault();
            alert("passwords must not be longer than 40 characters! try again");
            return;
        }

        if(registrationForm.elements.password.value != document.getElementById("confirmation").value){
            event.preventDefault();
            alert("passwords don\'t match! try again");
            return;
        }

        if(!validateEmail(registrationForm.elements.email.value)){
            event.preventDefault();
            alert("email not correct! try again");
            return;
        }

        //event.preventDefault();
    });
}








if(editUsernameButton){
    let editUsername = document.getElementById("editUsername"); 
    let editDescriptionButton = document.getElementById("editDescriptionButton");
    let editDescription = document.getElementById("editDescription");

    editUsernameButton.addEventListener("click", ()=>{
        editUsername.hidden = false;

        editUsername.elements.newUsername.style.width = document.getElementById("current-username").offsetWidth + "px";
        editUsername.style.left = document.getElementById("current-username").offsetLeft + "px";

        editUsername.elements.newUsername.focus();
    });

    editUsername.elements.cancell.addEventListener("click", ()=>{
        editUsername.hidden = true;
    });

    editDescriptionButton.addEventListener("click", ()=>{
        editDescription.hidden = false;
        
        editDescription.elements.newDescription.style.width = document.querySelector(".profile-info .description").offsetWidth + "px";
        editDescription.elements.newDescription.style.height = document.querySelector(".profile-info .description").offsetHeight + "px";

        if(editDescription.elements.newDescription.offsetWidth <= 100){
            editDescription.elements.newDescription.style.width = "300px";
            editDescription.style.left = - (editDescription.elements.newDescription.offsetWidth / 2) + "px";
        }

        editDescription.elements.newDescription.focus();
    });

    editDescription.elements.cancell.addEventListener("click", ()=>{
        editDescription.hidden = true;
    });

    editUsername.addEventListener("submit", (event)=>{
        if( editUsername.elements.newUsername.value.length < 6 || editUsername.elements.newUsername.value.length >= 32 ) {
            event.preventDefault();
            alert("username must be at least 6 characters and no longer than 32 characters! try again");
            return;
        }
    });

    editDescription.addEventListener("submit", (event)=>{
        if( editDescription.elements.newDescription.value.length >= 300 ) {
            event.preventDefault();
            alert("username must not be longer than 300 characters! try again");
            return;
        }
     });
}









if(newProfilePicForm){
    newProfilePicForm.elements.newProfilePic.addEventListener("change", ()=>{
        if(!newProfilePicForm.elements.newProfilePic.files[0].type.startsWith("image/")){
            newProfilePicForm.elements.newProfilePic.value = "";
            alert("file must be an image!");
            return;
        } else{
            newProfilePicForm.submit();
        }
    });
}








if(profileOptions){
    let profileOptionsModal = document.querySelector(".profileOptionsModal");
    profileOptionsModal.hidden = true;
    let profileOptionsButton = document.getElementById("profileOptionsButton");

    profileOptionsButton.addEventListener("click", ()=>{
        openModal(profileOptionsModal);
    });

    profileOptionsModal.addEventListener("click", (event) => {
        if(event.target == profileOptionsModal || event.target == profileOptionsModal.querySelector(".modalContent")){
            closeModal(profileOptionsModal);
        }
    });

    profileOptionsModal.querySelector(".cancelOptions").addEventListener("click", ()=>{
        closeModal(profileOptionsModal);
    });
}