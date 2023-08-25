//progress
document.addEventListener("DOMContentLoaded", function() {//Dom connexion full  load
(() => {
    var progressBar = document.querySelector(".progress");//progress bar

    for (i = 0; i < 100; i++){//boucle pour créer les 100 span
        let span = document.createElement("span");//création des span
        span.style.setProperty("--i", i);//ajout de la variable i dans le css
        progressBar.append(span);//ajout des span dans la progress bar
    }
})();

// List of audio elements
let audios = document.querySelectorAll("audio");//récupération de tous les éléments audio
console.log(audios);//affichage des éléments audio

// Index of the current audio
let currentAudioIndex = 0;

// Get the current audio element
function currentAudio() {//fonction pour récupérer l'audio actuel
    return audios[currentAudioIndex];//retourne l'audio actuel
}

// Function to update the time
function updateTime() {
    // Update the progress bar
    let position = Math.floor((currentAudio.currentTime * 100) / currentAudio.duration);//calcul de la position de la barre de progression
    list_span[position].classList.add("active");//ajout de la classe active à la span correspondante
}

// Function to reset the player
function resetPlayer() {
    // Reset the time display
    let currentTimeDisplay = document.querySelector(".current");//récupération de l'élément current
    currentTimeDisplay.textContent = "0:00";//remise à zéro du temps actuel
    
    // Reset the progress bar
    list_span.forEach((e) => {//boucle pour enlever la classe active à toutes les span
        e.classList.remove("active");//enlève la classe active
    })
}

// Function to go to the next audio
function nextAudio() {
    currentAudioIndex++;
    if (currentAudioIndex >= audios.length) {
        currentAudioIndex = 0;  // Loop back to the first audio
    }
    updateAudio();
}

// Update the audio element event listeners when the current audio changes
function updateAudio() {
    // Remove event listeners from all audio elements
    audios.forEach((audio) => {//boucle pour enlever les event listeners
        audio.removeEventListener("timeupdate", updateTime);//enlève l'event listener
        audio.removeEventListener("ended", resetPlayer);
    });

    // Add event listeners to the current audio element
    let audio = currentAudio();//récupération de l'audio actuel
    if (audio) {//si l'audio existe
        audio.addEventListener("timeupdate", updateTime);//ajout de l'event listener
        audio.addEventListener("ended", resetPlayer);//ajout de l'event listener
    }
    console.log("Mise à jour de l'audio, titre actuel : " + titles[currentAudioIndex]);//affichage du titre de l'audio actuel
    let songTitleName = document.querySelector(".song-title");//récupération de l'élément song-title
    songTitleName.textContent = titles[currentAudioIndex];//affichage du titre de l'audio actuel

    console.log("Mise à jour de l'audio, titre actuel : " + titles[currentAudioIndex]);//affichage du titre de l'audio actuel

    
}

// Call this function whenever the current audio changes
updateAudio();

/**
 * Audio player controls
 */
let play_pause = document.querySelector(".play_pause");//récupération de l'élément play_pause
let duration = document.querySelector(".duration");//récupération de l'élément duration
let current = document.querySelector(".current");//récupération de l'élément current
let list_span = document.querySelectorAll(".progress span");//récupération de tous les éléments span
let volume_span = document.querySelectorAll(".volume span");//récupération de tous les éléments span

let timeFormat = (time) => {//fonction pour formater le temps
    let second = Math.floor(time % 60);//calcul des secondes
    let minute = Math.floor((time / 60) % 60);//calcul des minutes
    if (second < 10) {//si les secondes sont inférieures à 10
        second = "0" + second;//ajout d'un 0 devant
    }

    time = minute + ":" + second;//formatage du temps en minute:seconde
    return time;
};
 
// Update duration when metadata is loaded
currentAudio().addEventListener("loadedmetadata", () => {//quand les métadonnées sont chargées
    duration.textContent = timeFormat(currentAudio().duration);//affichage de la durée
});

play_pause.addEventListener("click", () => { //quand on clique sur play_pause
    let iBtn = document.querySelector(".play_pause i");//récupération de l'élément i

    if (currentAudio().paused) {//si l'audio est en pause
        currentAudio().play();//lecture de l'audio
        iBtn.classList.replace("bx-play-circle", "bx-pause-circle");//remplacement de l'icone play par pause
    } else {
        currentAudio().pause();//pause de l'audio
        iBtn.classList.replace("bx-pause-circle", "bx-play-circle");//remplacement de l'icone pause par play
    }
});

/**
 * Volume control
 */
currentAudio().volume = 0.5;

volume_span.forEach((element) => {
    element.addEventListener("click", (e) => { 
        let volume = 0;

        if (element.classList.contains("volume-down")) {
            volume = currentAudio().volume - 0.1;
        } else if (element.classList.contains("volume-up")) {
            volume = currentAudio().volume + 0.1;
        }

        if (volume < 0) {
            currentAudio().volume = 0;
        } else if (volume > 1) {
            currentAudio().volume = 1;
        } else {
            currentAudio().volume = volume;
        }

        let width = currentAudio().volume * 150;
        let bar = document.querySelector(".volume-bar");
        bar.style.setProperty("width", width + "px");
    }); 
});

//...
/**
 * Seeking
 */
list_span.forEach((element, index) => {//boucle pour chaque élément span
    element.addEventListener("click", (e) => {//quand on clique sur l'élément
        //remove active classes
        list_span.forEach((e) => {//boucle pour enlever la classe active à toutes les span
            e.classList.remove("active");//enlève la classe active
        })

        //add active class to selected range
        for (k = 0; k <= index; k++){//boucle pour ajouter la classe active à toutes les span jusqu'à l'index
            list_span[k].classList.add("active");//ajoute la classe active
        }

        //set current time
        let time_go = (index * currentAudio().duration) / 100;//calcul du temps
        currentAudio().currentTime = time_go;//définition du temps
    })
    
});
let prevButton = document.querySelector("#prev");
let nextButton = document.querySelector("#next");

prevButton.addEventListener("click", () => {
    currentAudio().pause(); // Cette ligne arrête la lecture de l'audio actuel.
    currentAudio().currentTime = 0; // Cette ligne réinitialise le temps de l'audio actuel à 0, c'est-à-dire au début de l'audio.
    currentAudioIndex--; // Cette ligne décrémente l'index de l'audio actuel, ce qui signifie que nous passons à l'audio précédent.
    if (currentAudioIndex < 0) {
        currentAudioIndex = audios.length - 1;  // Si l'index de l'audio actuel est inférieur à 0 (c'est-à-dire si nous sommes déjà au premier audio et que nous essayons de passer à l'audio précédent), cette ligne nous ramène à l'audio final.
    }
    updateAudio(); // Cette ligne met à jour l'audio sur lequel nous travaillons. Elle supprime les gestionnaires d'événements de l'ancien audio et les ajoute au nouvel audio.
    currentAudio().play(); // Cette ligne commence à jouer le nouvel audio.
});


nextButton.addEventListener("click", () => {
    currentAudio().pause();
    currentAudio().currentTime = 0;
    currentAudioIndex++;
    if (currentAudioIndex >= audios.length) {
        currentAudioIndex = 0;  // Loop back to the first audio
    }
    updateAudio();
    currentAudio().play();
});

// Pour chaque icône de musique...
document.querySelectorAll('.music-icon').forEach(function(icon, index) {
    // Ajouter un écouteur d'événements 'click'...
    icon.addEventListener('click', function() {
        let player = document.querySelector('section');
        // Si le lecteur est déjà actif, le cacher...
        if (player.classList.contains('active')) {
            player.classList.remove('active');
        } 
        // Sinon, le montrer et commencer à jouer la piste correspondante...
        else {
            player.classList.add('active');
            currentAudio().pause(); // Pause the current audio.
            currentAudio().currentTime = 0; // Reset the current audio's time to 0.
            currentAudioIndex = index; // Update the current audio index to match the clicked music icon.
            //updateAudio(); // Update the audio we're working with.
            currentAudio().play(); // Start playing the new current audio.
        }
    });
});
// Lorsque l'audio est mis en pause ou la page est sur le point d'être déchargée, sauvegarder l'index de l'audio actuel et la position de lecture actuelle, le Timeupdate est utilisé pour sauvegarder la position de lecture actuelle à chaque seconde
currentAudio().addEventListener('pause', saveCurrentAudioState);
window.addEventListener('timeupdate', saveCurrentAudioState);

// Fonction pour sauvegarder l'index de l'audio actuel et la position de lecture actuelle
function saveCurrentAudioState() {
    localStorage.setItem('currentAudioIndex', currentAudioIndex);
    localStorage.setItem('currentTime', currentAudio().currentTime);
}

// Lorsque la page est chargée, récupérer l'index de l'audio actuel et la position de lecture actuelle et les utiliser
window.addEventListener('load', function() {
    if (localStorage.getItem('currentAudioIndex')) {
        currentAudioIndex = Number(localStorage.getItem('currentAudioIndex'));
    }

    // Si l'index de l'audio actuel est supérieur ou égal à la longueur de la liste des audios, le ramener à 0
    if (currentAudioIndex >= audios.length) {
        currentAudioIndex = 0;
    }

    if (localStorage.getItem('currentTime')) {
        currentAudio().currentTime = Number(localStorage.getItem('currentTime'));
        console.log("Temps de l'audio actuel : " + currentAudio().currentTime);
    }
    updateAudio();
});



});


// Voici une explication de certaines parties du code :

// let audios = document.querySelectorAll("audio"); : Cette ligne sélectionne tous les éléments audio sur la page et les stocke dans la variable audios. Chaque élément audio représente un fichier audio différent.

// let currentAudioIndex = 0; : Cette ligne définit l'index de l'audio actuel sur 0, ce qui signifie que le premier audio dans la liste sera joué en premier.

// function currentAudio() { return audios[currentAudioIndex]; } : Cette fonction renvoie l'audio actuel en fonction de l'index de l'audio actuel.

// currentAudio().pause(); currentAudio().currentTime = 0; : Ces lignes arrêtent la lecture de l'audio actuel et réinitialisent le temps de l'audio à 0, ce qui signifie que l'audio recommence depuis le début.

// currentAudioIndex--; et currentAudioIndex++; : Ces lignes décrémentent ou incrémentent l'index de l'audio actuel, ce qui signifie que nous passons à l'audio précédent ou suivant.

// if (currentAudioIndex < 0) { currentAudioIndex = audios.length - 1; } et if (currentAudioIndex >= audios.length) { currentAudioIndex = 0; } : Ces lignes vérifient si nous avons atteint le début ou la fin de la liste des audios. Si c'est le cas, elles nous ramènent à l'autre extrémité de la liste.

// updateAudio(); : Cette ligne met à jour l'audio sur lequel nous travaillons. Elle supprime les gestionnaires d'événements de l'ancien audio et les ajoute au nouvel audio.

// currentAudio().play(); : Cette ligne commence à jouer le nouvel audio.