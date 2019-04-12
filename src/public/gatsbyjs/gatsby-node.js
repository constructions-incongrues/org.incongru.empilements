const path = require('path');

console.log('KLKFELKFEOKFEOKF');
// Gatsby function that runs during build after generating GraphQL store
exports.createPages = async ({ actions, graphql }) => {
  const { createPage } = actions;
  try {
    const result = await graphql(`
      {
        allDirectusEmpilement {
          edges {
            node {
              directusId
              title
            }
          }
        }
      }
    `);

    result.data.allDirectusEmpilement.edges.map(edge => {
      try {
        const node = edge.node;
        const url = `/${node.directusId}`;
        createPage({
          path: url,
          component: path.resolve('src/templates/empilement.jsx'),
          context: {
            // Used as a query argument in the component below
            id: node.directusId,
          },
        });
        console.log(`Generated empilement '${node.title}' to path '${url}'`);
      } catch (error) {
        console.error(`Failed to generate empilement '${node.title}': ${error}`);
      }
    });
  } catch (error) {
    console.error(`GraphQL query returned error: ${error}`);
  }
};
