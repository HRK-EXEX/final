/*  --------------------
|   newTreasure.php    |
--------------------  */

var ranklist = "EDCBAS";
function showRank(rank) {
    if (rank != "" || rank != null) {
        if (rank < ranklist.length) {
            return ranklist.charAt(rank);
        } else return ranklist.charAt(5)+(rank-5);
    }
    return "";
}

function previewRank() {
    var rank = document.getElementById('rank');
    var show = document.getElementById('previewZone');
    show.innerHTML = showRank(rank.value);
}