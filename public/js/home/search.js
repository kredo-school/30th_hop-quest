
// to change content depending on tab
    document.querySelectorAll('.tag-category a').forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();

            const targetId = tab.getAttribute('href').substring(1);

            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.tag-category a').forEach(link => {
                link.classList.remove('active');
                const img = link.querySelector('img');
                if(img && img.dataset.default){
                    img.src = img.dataset.default;
                }
            });
            
            
            document.getElementById(targetId).classList.add('active');
            tab.classList.add('active');

            const activeImg = tab.querySelector('img');
            if(activeImg && activeImg.dataset.active){
                activeImg.src = activeImg.dataset.active;
            }
        });
    });



    window.addEventListener('DOMContentLoaded', () => {
        const defaultTab = 'tab-all';

        document.getElementById(defaultTab).classList.add('active');
        const defaultLink = document.querySelector(`.tag-category a[href="#${defaultTab}"]`);
        if(defaultLink){
            defaultLink.classList.add('active');

            const defaultImg = defaultLink.querySelector('img');
            if(defaultImg && defaultImg.dataset.active){
                defaultImg.src = defaultImg.dataset.active;
            }
            
        }
    });


    // document.addEventListener('DOMContentLoaded', function(){
    //     const sortSelect = document.getElementById('dropdown-sort');

    //     sortSelect.addEventListener('change', function(){
    //         const sortValue = this.value;

    //         const activeTab = document.querySelectorAll('.tab-content.active');
    //         const postList = activeTab.querySelector('[id^="post-list"]');

    //         fetch('/search/sort?sort=${sortValue}')
    //         .then(response => response.text())
    //         .then(html => {
    //             document.getElementById('post-list').innerHTML = html;
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //         });
    //     });
    // });
