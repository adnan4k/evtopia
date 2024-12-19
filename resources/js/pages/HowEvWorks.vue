<template>
    <div style="position: relative; padding-bottom: 555%;">
        <!-- Overlay div to cover the banner area -->
        <div class="iframe-overlay"></div>
        <iframe src="https://animagraffs.com/electric-car/"
                style="top: -3.5%; position: absolute; z-index: -10; width: 100%; height: 20000px;"
                frameborder="no" border="0" marginwidth="0" marginheight="0"
                scrolling="no" allowtransparency="yes"></iframe>
    </div>
</template>

<style scoped>
.iframe-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px; /* Adjust height to cover the banner */
    background-color: white; /* Match page background */
    z-index: 1;
}
iframe {
    z-index: 0;
}
</style>
