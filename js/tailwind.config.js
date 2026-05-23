tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        primary: "#3D261C", // Deep Espresso Brown from Logo
        "on-primary": "#F2E5D5", // Light Cream from Logo
        "primary-container": "#523629", // Slightly lighter espresso
        "on-primary-container": "#C9B6A3", // Tan accent
        secondary: "#C9B6A3", // Tan/Bronze from Logo
        "on-secondary": "#3D261C",
        "secondary-container": "#E5D1C0", // Light tan
        "on-secondary-container": "#3D261C",
        tertiary: "#8B6F5B", // Mid-tone brown from logo details
        surface: "#C9B6A3", // Beige color from logo
        "surface-variant": "#E5D1C0",
        "on-surface-variant": "#523629",
        outline: "#3D261C",
        "outline-variant": "#C9B6A3",
        background: "#C9B6A3",
      },
      borderRadius: {
        DEFAULT: "0.125rem",
        lg: "0.25rem",
        xl: "0.5rem",
        full: "0.75rem",
      },
      fontFamily: {
        headline: ["Noto Serif"],
        body: ["Manrope"],
        label: ["Manrope"],
      },
    },
  },
};
