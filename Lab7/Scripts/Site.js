class Picture {
    constructor(id, name, originalLink, albumLink, thumbLink) {
        this.id = id;
        this.name = name;
        this.originalLink = originalLink;
        this.albumLink = albumLink;
        this.thumbLink = thumbLink;
        this.currentRotation = 0;
    }

    rotateLeft() {
        this.currentRotation += 90;
        //if (this.currentRotation >= 360) { this.currentRotation -= 360; }
    }
    rotateRight() {
        this.currentRotation -= 90;
        //if (this.currentRotation <= -360) { this.currentRotation += 360; }
    }
}


$(document).ready(() => {
    // Set the Current Picture Variable
    var currentPicture = new Picture(
        $("#currentImage").attr("data-id"),
        $("#currentImage").attr("data-name"),
        $("#currentImage").attr("data-original-src"),
        $("#currentImage").attr("data-album-src"),
        $("#currentImage").attr("data-thumbnail-src"),
    );

    //Image Change Event Handlers
    $(".thumbnailImage").on("click", (e) => {
        //alert("Thumbnail Image Clicked: ");

        // Cache the variables
        var $this = $(e.currentTarget);
        var currentImage = $("#currentImage");
        var currentImageName = $("#currentImageName");
        var downloadLink = $("#downloadLink");

        // Update the new image
        currentPicture = new Picture(
            $this.attr("data-id"),
            $this.attr("data-name"),
            $this.attr("data-original-src"),
            $this.attr("data-album-src"),
            $this.attr("data-thumbnail-src"),
        );

        // Set the Misc Data
        currentImageName.text(currentPicture.name);
        downloadLink.attr("href", currentPicture.originalLink);

        // Change the Preview Image
        currentImage.attr("src", currentPicture.albumLink);
        currentImage.attr("data-id", currentPicture.id);
        currentImage.attr("data-name", currentPicture.name);
        currentImage.attr("data-original-src", currentPicture.originalLink);
        currentImage.attr("data-album-src", currentPicture.albumLink);
        currentImage.attr("data-thumbnail-src", currentPicture.thumbLink);
    });

    // Image Button Event Handlers
    $(".imageButton").on("click", (e) => {
        //alert("Preview Image Button Clicked: ");

        // Cache the variables
        var $this = $(e.currentTarget);
        var currentImage = $("#currentImage");
        var downloadLink = $("#downloadLink");

        switch ($this.attr("data-action")) {
            case "rotateLeft":
                currentPicture.rotateLeft();
                var params = [
                    "action=rotateLeft",
                    "currentRotation=" + currentPicture.currentRotation,
                    "filePath=" + encodeURIComponent(currentPicture.albumLink)
                ];

                var url = "http://" + window.location.host + "/Common/DisplayPicture.php" + '?' + params.join('&');
                console.log(url);
                console.log(params.join("&"));
                currentImage.attr("src", url);
                //downloadLink.attr("href", url);

                return;
            case "rotateRight":
                currentPicture.rotateRight();
                var params = [
                    "action=rotateRight",
                    "currentRotation=" + currentPicture.currentRotation,
                    "filePath=" + encodeURIComponent(currentPicture.albumLink)
                ];

                var url = "http://" + window.location.host + "/Common/DisplayPicture.php" + '?' + params.join('&');
                console.log(url);
                console.log(params.join("&"));
                currentImage.attr("src", url);
                //downloadLink.attr("href", url);

                return;
            case "download": return;
            case "delete":
                var params = [
                    "action=delete",
                    "filePath=" + encodeURIComponent(currentPicture.thumbLink)
                ];

                window.location.href = "http://" + window.location.host + window.location.pathname + '?' + params.join('&');
                return;
            default: break;
        }
    });
});