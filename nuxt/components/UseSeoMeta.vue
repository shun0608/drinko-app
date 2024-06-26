<script setup>
const props = defineProps({
  title: {
    type: String,
    default: "Drinko",
  },
  description: {
    type: String,
    default: "丁寧に作ったドリンクで安らぎのひとときを",
  },
  imageUrl: {
    type: String,
    default: "~/assets/img/site-thumbnail.jpg",
  },
  imageType: {
    type: String,
    default: "image/jpeg",
  },
});

const route = useRoute();
const ogType = computed(() => {
  return route.path === "/" ? "website" : "article";
});
const currentUrl = computed(() => {
  return window.location.origin + route.fullPath;
});

useSeoMeta({
  // 全ページ共通
  ogLocale: "ja",
  ogSiteName: "Drinko",
  twitterCard: "summary",
  charset: "utf-8",
  author: "shun0608",
  viewport: "width=device-width, initial-scale=1.0",
  ogType: `${ogType.value}`,
  ogUrl: `${currentUrl.value}`,

  title: props.title,
  ogTitle: props.title,
  twitterTitle: props.title,

  description: props.description,
  ogDescription: props.description,
  twitterDescription: props.description,

  ogImage: {
    url: props.imageUrl,
    type: props.imageType,
  },
  twitterImage: {
    url: props.imageUrl,
    type: props.imageType,
  },
});
const render = () => h("");
</script>
