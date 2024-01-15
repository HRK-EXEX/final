/*  --------------------
|   newTreasure.php    |
--------------------  */

var ranklist = "EDCBAS";
function showRank(rank) {
    rank = parseInt(rank, 10);
    if (rank < ranklist.length) {
        return ranklist.charAt(rank);
    } else if (rank == "" || rank == null) {
        return "";
    }
    return ranklist.charAt(4)+(rank-4);
}

function previewRank() {
    var rank = document.getElementById('rank');
    var show = document.getElementById('previewZone');
    show.innerHTML = showRank(rank);
}