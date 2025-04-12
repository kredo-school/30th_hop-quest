    // Define some properties and function (if something is loaded, this function will be working)
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);  //to get URI after "?"" mark
    let currentTabCategory = urlParams.get('category') || 'all';    // if category = null, "all" will be retrieved
    let currentSortValue = urlParams.get('sort') || 'latest';       // if sort = null, "latest" will be...
    const currentPage = urlParams.get(`${currentTabCategory}_page`) || 1;
    const targetTabId = `tab-${currentTabCategory}`;                // ex: tab-all
    const defaultContent = document.getElementById(targetTabId);    // to found the id from search.blade (ex:id=tab-all)

    // To add Active to id=tab-xxx and 
    if (defaultContent) {
        defaultContent.classList.add('active');                     // to add active to defaultContent for using css
        const defaultLink = document.querySelector(`.tag-category a[href="#${targetTabId}"]`);  //to retrieve href="" from search page
        if (defaultLink) {
            defaultLink.classList.add('active');
        }
    }

    //  No.1 To switch value of dropdown-sort for sorting
    const dropdown = document.getElementById('dropdown-sort'); // to retrieve <select id ="dropdown-sort"....
    if (dropdown) {
        dropdown.value = currentSortValue; // to retrieve a value latest or oldest or likes or....

        dropdown.addEventListener('change', function () {
            currentSortValue = this.value; // to switch value from <select>tag
            sendSortRequest(currentTabCategory, currentSortValue, 1); // reset to page 1 by using ajax (users in page 2 and they wanna change sort setting, it should be back to page 1)
        });
    }

    //  No.2 To switch value of dropdown-sort for sorting
    document.querySelectorAll('.tag-category a').forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();                                         // if users clicked other tab, this function prevent page scroll.

            const targetId = this.getAttribute('href').substring(1);    // to cut first letter(#) from content of href
            currentTabCategory = this.dataset.category;                 // to get category form "data-category" on search.blade

            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });                                                         // remove "active" from all .tab-content for hiding
            document.getElementById(targetId).classList.add('active');  // to add for displaying only in one category

            document.querySelectorAll('.tag-category a').forEach(link => {
                link.classList.remove('active');
                // const img = link.querySelector('img');
                // if (img && img.dataset.default) {
                //     img.src = img.dataset.default;
                // }                                                    // this code for <img src="{{ asset('images/home/オリジナル（透過背景） black.png')}}, 
                                                                        // but this img doesn't exist on search.blade now, so I did comment out 
            });

            this.classList.add('active');
            // const activeImg = this.querySelector('img');
            // if (activeImg && activeImg.dataset.active) {
            //     activeImg.src = activeImg.dataset.active;
            // }                                                        // this code for <img src="{{ asset('images/home/オリジナル（透過背景） black.png')}}, 
                                                                        // but this img doesn't exist on search.blade now, so I did comment out 

            sendSortRequest(currentTabCategory, currentSortValue, 1);   // reset to first page
        });
    });

    // Event delegation for if added pagination link by ajax, delegation will makes it be reacted (I don't understand about event delegation....yet)
    document.addEventListener('click', function (e) {
        if (e.target.matches('.pagination a')) {                                        // if clicked pagination link....
            e.preventDefault();
            const url = new URL(e.target.href);                                         // ex: all_page=2
            const pageParam = url.searchParams.get(`${currentTabCategory}_page`) || 1;  // to retrieve xxx_page and if the url doesn't have a page number, will make it be initialized
            sendSortRequest(currentTabCategory, currentSortValue, pageParam);           // to retrieve new data using  currentTab, currentSort, page number by ajax 
        }
    });

    // Ajax - to refresh all data using tab, sort, page
    function sendSortRequest(category, sortValue, page = 1) {
        const searchInput = document.getElementById('searchInput');                           // to get value from <input type="hidden" type="text"id="searchInput"
        const searchValue = searchInput ? searchInput.value : '';
    
        // To set new URL
        const url = new URL(window.location.href);
        url.searchParams.set('search', searchValue);
        url.searchParams.set('sort', sortValue);
        url.searchParams.set('category', category);
        url.searchParams.set(`${category === 'all' ? 'all_page' : category + '_page'}`, page);
        window.history.replaceState({}, '', url);
    
        // Construction for sending to server
        const bodyData = {
            search: searchValue,
            sort: sortValue,
            'data-category': category
        };
    
        if (category === 'all') {
            bodyData.all_page = page;
        } else {
            bodyData.page = page;
        }
    
        // To send request to POST/sort
        fetch('/sort', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(bodyData)
        })
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById(`post-list-${category}`);
            if (container) {
                container.innerHTML = data.html;
            }
        })
        .catch(error => {
            console.error('Ajax error:', error);
        });
    }
    sendSortRequest(currentTabCategory, currentSortValue, 1);
});
