FROM node:10-alpine

WORKDIR /usr/local/src


RUN apk --update --no-cache add curl git make util-linux && \
    yarn global add gatsby-cli lerna

# Installation et configuration de fixuid
# https://github.com/boxboat/fixuid
RUN curl -SsL https://github.com/boxboat/fixuid/releases/download/v0.4/fixuid-0.4-linux-amd64.tar.gz | tar -C /usr/local/bin -xzf - && \
    chown root:root /usr/local/bin/fixuid && \
    chmod 4755 /usr/local/bin/fixuid && \
    mkdir -p /etc/fixuid && \
    printf "user: node\ngroup: node\n" > /etc/fixuid/config.yml

COPY --chown=node:node ./src/gatsbyjs /usr/local/src
RUN yarn install

USER node
ENTRYPOINT ["gatsby"]
