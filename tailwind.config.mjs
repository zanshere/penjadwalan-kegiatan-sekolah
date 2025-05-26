// tailwind.config.mjs
module.exports = {
    darkMode: 'class',
    content: ["./**/*.html", "./**/*.php", "./src/**/*.{js,ts,jsx,tsx}"],
    theme: {
      extend: {},
    },
    corePlugins: {
      backdropFilter: true,
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["light", "dark"], // aktifkan tema light & dark
      },
  };
  