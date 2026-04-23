##
# @see  https://govcms.gov.au/wiki-advanced#docker
#

ARG CLI_IMAGE
ARG GOVCMS_IMAGE_VERSION={{ GOVCMS_VERSION }}.x-latest

FROM ${CLI_IMAGE} as cli
FROM govcms/php:${GOVCMS_IMAGE_VERSION}

ARG LAGOON_PROJECT
ARG LAGOON_ENVIRONMENT

# Clean up base image so as not to conflict with any changes.
RUN rm -rf /app

COPY --from=cli /app /app

# Define HTTPAV identifier.
ENV HTTPAV_IDENTIFIER=${LAGOON_PROJECT}-${LAGOON_ENVIRONMENT}
