const namee = document.querySelector("#nom")
const id = document.querySelector("#id")
const pass = document.querySelector("#pass")
const form = document.querySelector("form")
const erBox = document.querySelector(".error")

form.addEventListener("submit",(e)=>{
    e.preventDefault();
    if(namee.value === "" || id.value === "" || pass.value ===""){
        erBox.style.display = "block"
        erBox.style.color = "rgb(255, 130, 130)"
        erBox.style.fontSize = "13px"
        erBox.textContent = "Veuillez remplir tous les champs"
    }else {
        document.myForm.submit();
    }
})