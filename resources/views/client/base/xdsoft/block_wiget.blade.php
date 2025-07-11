<style>
    .fixed-block-widget {
    position: fixed;
    top: 80%;
    left: 95%;
    transform: translate(-50%, -50%);
    z-index: 10;
    width: 100%;
  }
.sonar-wrapper {
  height: 100%;
}

.sonar-wrapper {
  position: relative;
  z-index: 0;
  overflow: hidden;
}

.sonar-emitter {
  position: relative;
  margin: 32px auto;
  width: 60px;
  height: 60px;
  border-radius: 9999px;
}
.sonar-emitter.green {
  background-color: #8ad336;
}

.sonar-emitter.darkblue {
  background-color: #3a8bff;
}

.sonar-wave {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 9999px;
  opacity: 0;
  z-index: -1;
}
.sonar-wave.green {
  background-color: #8ad336;
}

.sonar-wave.darkblue {
  background-color: #3a8bff;
}

.sonar-wave1 {
  animation: sonarWave 1.5s linear infinite;
}

.sonar-wave2 {
  animation: sonarWave 1.5s 0.5s linear infinite;
}


@keyframes sonarWave {
  from {
    opacity: 0.6;
  }
  to {
    transform: scale(1.8);
    opacity: 0;
  }
}

.sonar-image {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, 50%);
    width: 30px;
    height: 30px;
    z-index: 1;
  }
   @keyframes shake {
    0% { transform: skewX(-10deg); }
    5% { transform: skewX(10deg); }
    10% { transform: skewX(-10deg); }
    15% { transform: skewX(10deg); }
    20% { transform: skewX(0deg); }
    100% { transform: skewX(0deg); }

    
    }

    /* Áp dụng keyframes vào phần tử có lớp 'shaking-image' */
    .shaking-image {
      animation: shake 1.5s infinite; /* 0.5s là thời gian một chu kỳ rung lắc */
    }

.block-wiget-bottom {
display: none;
position: fixed;
bottom: 0;
display: flex;
width: 100%;
justify-content: space-around;
width: 100%;
background: white;
padding: 10px;
z-index: 1000000;
}

.block-wiget-bottom>.wiget-bottom {
text-align: center;
}

.block-wiget-bottom>.wiget-bottom>a {
height: 100%;
}

.block-wiget-bottom>.wiget-bottom>a>img {}
@media (max-width: 575.98px) {

    .block-wiget-bottom {
        display: inline;
        box-shadow: 0 -4px 8px rgba(29,36,62,.2);
    }
    .block-wiget {
        display: none;
    }

}
@media (min-width: 576px) and (max-width: 767.98px) {
    /* #navbarNavDropdown .navbar-nav {
        min-width: 100%;
        max-width: 100%;
    } */
    .block-wiget-bottom {
        display: inline;
    }
    .block-wiget {
        display: none;
    }
}
@media (min-width: 768px) and (max-width: 991.98px) {
    .block-wiget-bottom {
        display: none;
    }
    .block-wiget {
        display: inline;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {

    .block-wiget-bottom {
        display: none;
    }
    .block-wiget {
        display: inline;
    }
}

@media (min-width: 1200px) {
    .block-wiget-bottom {
        display: none;
    }
    .block-wiget {
        display: inline;
    }
}
</style>
<div class="fixed-block-widget block-wiget" style="width:120px;">
    <div class="sonar-wrapper">
        <a href="https://zalo.me/0345708107">
            <div class="sonar-emitter green">
                <div class="sonar-wave sonar-wave1 green"></div>
                <div class="sonar-wave sonar-wave2 green"></div>
                <div class="shaking-image">
                    <img src="../image/TrangChu/light-bulb.png" alt="Phone"
                        class="sonar-image" />
                </div>
            </div>
        </a>
        <a href="#" class="showModalButton">
            <div class="sonar-emitter darkblue" style="margin-top: 40px;">
                <div class="sonar-wave sonar-wave1 darkblue"></div>
                <div class="sonar-wave sonar-wave2 darkblue"></div>
                <div class="shaking-image">
                    <img src="../image/TrangChu/comment.png" alt="Messenger"
                        class="sonar-image" />
                </div>
            </div>
        </a>
    </div>
</div>

