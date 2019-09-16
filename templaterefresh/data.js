const data = {
	bannerData: [{
			iTitle: "Dayclar Global Ventures",
			iUrl: "assets/images/pinnock43.jpg",
			heading: "Dayclar Global Ventures",
			body: "We specialize in all things property."
		},
		{
			iTitle: "Dayclar Global Ventures",
			iUrl: "assets/images/pinnock42.jpg",
			heading: "Dayclar Global Ventures",
			body: "We specialize in all things property."
		},
		{
			iTitle: "Dayclar Global Ventures",
			iUrl: "assets/images/pinnock41.jpg",
			heading: "Dayclar Global Ventures",
			body: "We specialize in all things property."
		}
	]
}

const htmlWrapper = {
	createImg: function (imageUrl) {
		const image = document.createElement('img')
		image.src = imageUrl;

		return image;
	},

	createDiv: function (withClass = false) {
		const div = document.createElement('div');

		if (withClass) {
			div.classList.add(withClass);
		}

		return div;
	},

	createArticle: function () {
		return document.createElement('article');
	},

	createParagrapgh: function () {
		return document.createElement('p')
	},

	createHeadingTag: function (tagName) {
		return document.createElement(tagName);
	},

	createHeader: function () {
		return document.createElement('header');
	}
}