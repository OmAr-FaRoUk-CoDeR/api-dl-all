from pathlib import Path
from PIL import Image, ImageDraw, ImageFont

root = Path(__file__).resolve().parent
ICON_H = 84
GAP = 6


def build_lockup(icon_path, part1_rgb, part2_rgb, out_name):
    icon = Image.open(icon_path).convert("RGBA").resize((ICON_H, ICON_H), Image.Resampling.LANCZOS)
    try:
        font = ImageFont.truetype("arialbd.ttf", 26)
    except OSError:
        font = ImageFont.load_default()

    probe = Image.new("RGBA", (4, 4))
    d = ImageDraw.Draw(probe)
    w1 = d.textbbox((0, 0), "ONLINE ", font=font)[2]
    w2 = d.textbbox((0, 0), "GAMES", font=font)[2]
    text_w = w1 + w2
    W = text_w + GAP + ICON_H
    H = max(ICON_H, 40)
    canvas = Image.new("RGBA", (W, H), (0, 0, 0, 0))
    draw = ImageDraw.Draw(canvas)
    ty = (H - 30) // 2
    draw.text((0, ty), "ONLINE ", font=font, fill=part1_rgb)
    draw.text((w1, ty), "GAMES", font=font, fill=part2_rgb)
    ix = text_w + GAP
    iy = (H - ICON_H) // 2
    canvas.paste(icon, (ix, iy), icon)
    nh = 56
    nw = int(W * nh / H)
    canvas = canvas.resize((nw, nh), Image.Resampling.LANCZOS)
    canvas.save(root / out_name, optimize=True)
    print(out_name, nw, nh)


build_lockup(
    root / "logo-dark.png",
    (180, 188, 198, 255),
    (255, 120, 20, 255),
    "logo-lockup-dark.png",
)
build_lockup(
    root / "logo-light.png",
    (28, 28, 28, 255),
    (210, 20, 0, 255),
    "logo-lockup-light.png",
)
