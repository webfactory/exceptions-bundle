# Upgrading notes

We're trying to follow [SemVer](http://semver.org) principles to the best of our abilities and also to release versions as often as possible.

This document tries to point out the things you ought to keep in mind when trying to newer versions.

## 5.0.0

* Removed the custom controller logic that could be used to preview error pages. This code has become part of the Symfony Core in 2.6, so it was no longer necessary for a long time.

## 4.0.0

* Major version bump due to a change in HTML markup in 9eb3ec4f134e34c93ba8f7927764e9e005de3fe7. You might need to update your styles/CSS.
