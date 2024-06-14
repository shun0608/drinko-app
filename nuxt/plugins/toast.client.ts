import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css'; // デフォルトのCSSを使う

export default defineNuxtPlugin((_nuxtApp) => {
  return {
    provide: {
      toast: useToast({
        position: 'top-right', // たとえば右上に表示する
        duration: 5000 // たとえば5秒間表示する
      })
    }
  };
});