function openForm(id, name, size, population, code) {
    document.getElementById("myForm").style.display = "block";
    document.getElementById("editId").value = id;
    document.getElementById("editName").value = name;
    document.getElementById("editSize").value = size;
    document.getElementById("editPopulation").value = population;
    document.getElementById("editCode").value = code;
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

function filterBtn() {
    var x = document.getElementById("filters");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}