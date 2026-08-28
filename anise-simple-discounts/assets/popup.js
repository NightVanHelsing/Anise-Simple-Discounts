window.addEventListener('load',asd_disableOnLoad);
function asd_disableOnLoad() {
    const asd_disableButton = document.querySelector("#deactivate-anise-simple-discounts");
    const asd_DisableButtonHref = asd_disableButton.href;
    document.querySelector('#asd_disable').href = asd_DisableButtonHref;
    document.querySelector('#asd_delData').addEventListener('click',asd_delDataHandler);
    document.querySelector('#asd_cancel').addEventListener('click',() => {
        document.querySelector('.asd_popup').style.display = "none"
    })
    async function asd_delDataHandler(event) {
        event.preventDefault();
        try {
        const response = await fetch(asd_ajax.ajaxurl, {
            method:  "POST",
            body: new URLSearchParams({
                action: 'asd_deleteMeta',
                nonce: asd_ajax.nonce,
            })
        })
        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`)
        }
        const data = await response.json()
        if (!data.success) {
            return;
        }
        document.querySelector('.asd_popup').style.display = "none";
        window.location.href = asd_DisableButtonHref;
    }   catch (error) {
        console.error('Ajax error: ',error)
    }} 
    asd_disableButton.addEventListener('click', (event) => {
        event.preventDefault();
        document.querySelector('.asd_popup').style.display = "flex";
    });
}

