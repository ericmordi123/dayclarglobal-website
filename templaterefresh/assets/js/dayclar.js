$(document).ready(function () {


	const $dayclar = (function () {

		const appname = 'Dayclar';
		const appData = data;
		const currentDate = Date.now();


		// get banner class & elements
		const bannerDiv = document.getElementById('banner-home');
		const homeBannerData = appData.bannerData;
		let homeBannerElements = [];

		return {
			test: function () {
				console.log('TEST FUNCTION WORKS');
			},

			initialzieHomeBanner: function () {
				var fragment = document.createDocumentFragment();

				homeBannerData.forEach(function (slide) {
					// setup
					let imageArticle = htmlWrapper.createArticle();
					const innerDiv = htmlWrapper.createDiv('inner');
					const header = htmlWrapper.createHeader();
					const p = htmlWrapper.createParagrapgh();
					const h2 = htmlWrapper.createHeadingTag('h2');
					h2.innerHTML = slide.heading;
					p.innerHTML = slide.body;

					// join html elements together
					imageArticle.appendChild(htmlWrapper.createImg(slide.iUrl));
					header.appendChild(p);
					header.appendChild(h2);
					innerDiv.appendChild(header);
					imageArticle.appendChild(innerDiv);

					fragment.appendChild(imageArticle);
				})

				return fragment;
			},

			initializeSlick: function () {
				$('.slide-carousel').slick({
					dots: true,
					infinite: true,
					speed: 300,
					slidesToShow: 1,
					adaptiveHeight: true
				});
			},

			displayBannerImages: function () {
				const bannerSetup = this.initialzieHomeBanner();

				bannerDiv.appendChild(bannerSetup);
			}
		}
	})();


	$dayclar.displayBannerImages();
	$dayclar.initializeSlick();
})