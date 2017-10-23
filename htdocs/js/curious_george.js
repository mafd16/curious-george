"use strict";


// For expanding "Comment the question" in route questions/:id
/*function togglePostComment() {
    var x = document.getElementById("commentquestionform");

    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}*/

function togglePostComment(event) {
    if (event.target && event.target.className == 'is-size-7 comment-question') {
        var x = document.getElementById("commentquestionform");

        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
}

// For expanding "Comment the answers" in route questions/:id
function toggleDocs(event) {
    if (event.target && event.target.className == 'is-size-7 comment-answer') {
        var next = event.target.nextElementSibling;

        if (next.style.display == "none") {
            next.style.display = "block";
        } else {
            next.style.display = "none";
        }
    }
}

document.addEventListener('click', toggleDocs, true);

// Tesing!
document.addEventListener('click', togglePostComment, true);
