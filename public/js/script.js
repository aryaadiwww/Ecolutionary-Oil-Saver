const btn = document.getElementById("menu");
const addRadius = document.getElementById("round-onclick");
const navbarCollapse = document.querySelector(".navbar-collapse");
const navbar = document.querySelector(".navbar");

btn.addEventListener("click", function () {
    addRadius.classList.toggle("radius-50");
    navbarCollapse.classList.remove("show");
});

document.addEventListener("click", function (e) {
    if (
        !navbar.contains(e.target) &&
        !e.target.classList.contains("navbar-toggler")
    ) {
        navbarCollapse.classList.remove("show");
        addRadius.classList.remove("radius-50");
    }
});

window.addEventListener("scroll", function () {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > this.lastScrollY) {
        navbar.classList.add("navbar-scroll-up");
        navbar.classList.remove("navbar-scroll-down");
    } else {
        navbar.classList.remove("navbar-scroll-up");
        navbar.classList.add("navbar-scroll-down");
    }
    this.lastScrollY = window.scrollY;
});

let text = document.getElementById("text");
let bird1 = document.getElementById("bird1");
let bird2 = document.getElementById("bird2");
let sectionTwo = document.getElementById("two");

window.addEventListener("scroll", function () {
    let value = window.scrollY;

    // Check if the user has reached Section Two
    if (value > sectionTwo.offsetTop - window.innerHeight / 1.5) {
        // Apply animations only if the user is in Section Two
        text.style.top = 50 + (value - sectionTwo.offsetTop) * -0.1 + "%";
        bird2.style.top = (value - sectionTwo.offsetTop) * -1.5 + "px";
        bird2.style.left = (value - sectionTwo.offsetTop) * 2 + "px";
        bird1.style.top = (value - sectionTwo.offsetTop) * -1.5 + "px";
        bird1.style.left = (value - sectionTwo.offsetTop) * -5 + "px";
    }
});

(function () {
    var slidersContainer = document.querySelector(".sliders-container");

    // Initializing the numbers slider
    var msNumbers = new MomentumSlider({
        el: slidersContainer,
        cssClass: "ms--numbers",
        range: [1, 4],
        rangeContent: function (i) {
            return "0" + i;
        },
        style: {
            transform: [{ scale: [0.4, 1] }],
            opacity: [0, 1],
        },
        interactive: false,
    });

    // Initializing the titles slider
    var titles = [
        "Together<br>We Can ...",
        "Create a<br>Better World",
        "For Our<br>Children ...",
        "Starting with<br>Simple Actions",
    ];
    var msTitles = new MomentumSlider({
        el: slidersContainer,
        cssClass: "ms--titles",
        range: [0, 3],
        rangeContent: function (i) {
            return "<h3>" + titles[i] + "</h3>";
        },
        vertical: true,
        reverse: true,
        style: {
            opacity: [0, 1],
        },
        interactive: false,
    });

    // Initializing the links slider
    var msLinks = new MomentumSlider({
        el: slidersContainer,
        cssClass: "ms--links",
        range: [0, 3],
        rangeContent: function () {
            return '<a class="ms-slide__link"></a>';
        },
        vertical: true,
        interactive: false,
    });

    // Get pagination items
    var pagination = document.querySelector(".pagination");
    var paginationItems = [].slice.call(pagination.children);

    // Initializing the images slider
    var msImages = new MomentumSlider({
        // Element to append the slider
        el: slidersContainer,
        // CSS class to reference the slider
        cssClass: "ms--images",
        // Generate the 4 slides required
        range: [0, 3],
        rangeContent: function () {
            return '<div class="ms-slide__image-container"><div class="ms-slide__image"></div></div>';
        },
        // Syncronize the other sliders
        sync: [msNumbers, msTitles, msLinks],
        // Styles to interpolate as we move the slider
        style: {
            ".ms-slide__image": {
                transform: [{ scale: [1.5, 1] }],
            },
        },
        // Update pagination if slider change
        change: function (newIndex, oldIndex) {
            if (typeof oldIndex !== "undefined") {
                paginationItems[oldIndex].classList.remove(
                    "pagination__item--active"
                );
            }
            paginationItems[newIndex].classList.add("pagination__item--active");
        },
    });
    // Select corresponding slider item when a pagination button is clicked
    pagination.addEventListener("click", function (e) {
        if (e.target.matches(".pagination__button")) {
            var index = paginationItems.indexOf(e.target.parentNode);
            msImages.select(index);
        }
    });
})();

class Accordion {
    constructor(el) {
        this.el = el;
        this.summary = el.querySelector("summary");
        this.content = el.querySelector(".faq-content");
        this.expandIcon = this.summary.querySelector(".expand-icon");
        this.animation = null;
        this.isClosing = false;
        this.isExpanding = false;
        this.summary.addEventListener("click", (e) => this.onClick(e));
    }

    onClick(e) {
        e.preventDefault();
        this.el.style.overflow = "hidden";

        if (this.isClosing || !this.el.open) {
            this.open();
        } else if (this.isExpanding || this.el.open) {
            this.shrink();
        }
    }

    shrink() {
        this.isClosing = true;

        const startHeight = `${this.el.offsetHeight}px`;
        const endHeight = `${this.summary.offsetHeight}px`;

        if (this.animation) {
            this.animation.cancel();
        }

        this.animation = this.el.animate(
            {
                height: [startHeight, endHeight],
            },
            {
                duration: 400,
                easing: "ease-out",
            }
        );

        this.animation.onfinish = () => {
            this.expandIcon.setAttribute("src", "assets/plus.svg");
            return this.onAnimationFinish(false);
        };
        this.animation.oncancel = () => {
            this.expandIcon.setAttribute("src", "assets/plus.svg");
            return (this.isClosing = false);
        };
    }

    open() {
        this.el.style.height = `${this.el.offsetHeight}px`;
        this.el.open = true;
        window.requestAnimationFrame(() => this.expand());
    }

    expand() {
        this.isExpanding = true;

        const startHeight = `${this.el.offsetHeight}px`;
        const endHeight = `${
            this.summary.offsetHeight + this.content.offsetHeight
        }px`;

        if (this.animation) {
            this.animation.cancel();
        }

        this.animation = this.el.animate(
            {
                height: [startHeight, endHeight],
            },
            {
                duration: 350,
                easing: "ease-out",
            }
        );

        this.animation.onfinish = () => {
            this.expandIcon.setAttribute("src", "assets/minus.svg");
            return this.onAnimationFinish(true);
        };
        this.animation.oncancel = () => {
            this.expandIcon.setAttribute("src", "assets/minus.svg");
            return (this.isExpanding = false);
        };
    }

    onAnimationFinish(open) {
        this.el.open = open;
        this.animation = null;
        this.isClosing = false;
        this.isExpanding = false;
        this.el.style.height = this.el.style.overflow = "";
    }
}

document.querySelectorAll("details").forEach((el) => {
    new Accordion(el);
});
