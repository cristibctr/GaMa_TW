document.getElementsByTagName("form")[0].addEventListener('submit', fetchGames);
window.addEventListener('load', fetchGames);

async function fetchGames(event){
    //preparing url for GET request to the server
    var cats = document.getElementsByName('category[]');
    event.preventDefault();
    var relYear = document.getElementById('year').value;
    var age = document.getElementById('age').value ? document.getElementById('age').value : '%';
    var search = document.getElementById('search').value;
    var url = `/Games_Library/games_fetch.php?release-year=${relYear}&age=${age}&search=${search}&submit=submit`;
    for(var cat of cats){
        if(cat.checked){
            url += '&category[]=' + cat.id;
        }
    }
    //
    var request = new Request(url,{
        method:'GET'
    });
    var myFetch = await fetch(request);
    var fetchData = await myFetch.json();
    document.getElementsByClassName('games_grid')[0].innerHTML = '';
    for(data of fetchData){
        var gameWrapper = document.createElement("div");
        gameWrapper.classList.add('game-wrapper');
        gameWrapper.innerHTML = `<div class="game1">`+
                                    `<img alt="image" src="../Images/Games_List/${data.cover_image}">`+
                                    `<div class="gamecard-title"><p>${data.name}</p></div>`+
                                    `<div class="gamecard-release">`+
                                        `<p>Release year</p>`+
                                        `<p class="release-year">${data.year}</p>`+
                                    `</div>`+
                                    `<div class="gamecard-age">`+
                                        `<p>Age</p>`+
                                        `<p class="age">${data.age}+</p>`+
                                    `</div>`+
                                    `<div class="link-wrapper">`+
                                        `<a href="../Game_page/Game_page.php?name=${data.name}">`+
                                            `<div class="button"><p>Details</p></div>`+
                                        `</a>`+
                                    `</div>`+
                                `</div>`;+
        document.getElementsByClassName('games_grid')[0].appendChild(gameWrapper);
    }
}