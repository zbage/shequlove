<div ng-controller="Auth">
    <div ng-if="isGuest" ng-style="style">
        <iframe ng-src="{{loginSrc}}" name="login_frame" frameborder="0" scrolling="auto" width="100%" height="100%" src=""></iframe>
    </div>
</div>