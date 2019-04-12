module.exports = {
  siteMetadata: {
    title: `Gatsby Default Starter`,
    description: `Kick off your next, great Gatsby project with this default starter. This barebones starter ships with the main Gatsby configuration files you might need.`,
    author: `@gatsbyjs`,
  },
  plugins: [
    `gatsby-plugin-react-helmet`,
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `images`,
        path: `${__dirname}/src/images`,
      },
    },
    `gatsby-transformer-sharp`,
    `gatsby-plugin-sharp`,
    {
      resolve: `gatsby-plugin-manifest`,
      options: {
        name: `gatsby-starter-default`,
        short_name: `starter`,
        start_url: `/`,
        background_color: `#663399`,
        theme_color: `#663399`,
        display: `minimal-ui`,
        icon: `src/images/gatsby-icon.png`, // This path is relative to the root of the site.
      },
    },
    {
      resolve: 'gatsby-source-directus7',
      options: {
        /**
         * The base URL of Directus.
         */
        url: 'http://api.empilements.localhost',
        /**
         * Directus project to connect to, if empty defaults to '_' (Directus's default project name).
         */
        project: '_',
        /**
         * If your Directus installation needs authorization to access the required api,
         * you'll also need to supply the credentials here. In addition to your own
         * Collections, the Directus System Collections 'Collections', 'Files'
         * and 'Relations' should be readable either to the Public group
         * or the user account you provide.
         */
        email: 'gatsbyjs@empilements.incongru.org',
        password: 'gatsby',
      },
    }
    // this (optional) plugin enables Progressive Web App + Offline functionality
    // To learn more, visit: https://gatsby.dev/offline
    // `gatsby-plugin-offline`,
  ],
}
